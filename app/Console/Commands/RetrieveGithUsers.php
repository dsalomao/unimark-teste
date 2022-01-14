<?php

namespace App\Console\Commands;

use App\Jobs\SaveGhUser;
use App\Models\GhRequest;
use App\Models\GhUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use function Clue\StreamFilter\fun;

class RetrieveGithUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:gitusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retorna usuários da plataforma github com as características desejadas do teste.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command - Comando para buscar usuários na API do Github a partir dos parâmetros $endpoint, $query e $per_page
     * As consultas são salvas em uma tabela no banco para poder administrar todas as consultas realizadas para o conjunto de parâmetros
     * e parar quando tiver percorrido todas as páginas do endpoint
     *
     * @return int
     */
    public function handle()
    {
        $endpoint = 'https://api.github.com/search/users';
        $query = 'type:"user" language:"php" language:"laravel" repos:>1 is:public location:"brasil" location:"brazil" repos:1:stars:>9';
        $per_page = 100;

        $last_request = GhRequest::where(['endpoint' => $endpoint, 'query' => $query, 'per_page' => $per_page])->orderBy('page', 'desc')->first();

        if($last_request) {
            if($last_request['page'] <= $last_request['last']) {
                $page = $last_request['page'] + 1;
                $last = $last_request['last'];
                
                $this->jobRequests($endpoint, $query, $per_page, $page, $last);
            }
        } else {
            $page = 1;
                
            $this->jobRequests($endpoint, $query, $per_page, $page);
        }
    }

    /**
     * Transforma os requests em blocos de 300 Programadores em 1 job na fila com esse conteúdo, a não ser que tenha chegado ná última página da consulta, quando não faz nada.
     *
     * @param string $endpoint  Github API endpoint
     * @param string $query Github API media querys
     * @param int $per_page Number of rows per response page
     * @param int $initial_page Initial page to itarate till it has 300 rows
     * @param int $last Last    Page available for this endpoint, query, rows per page combination.
     * 
     * @return void
     */
    private function jobRequests($endpoint, $query, $per_page, $initial_page, $last = null) 
    {
        $collection = collect();
        $ceiling = ($initial_page + 2);
        $last = $last ? $last : $ceiling;

        while ($initial_page <= $ceiling && $initial_page <= $last) { 
            $response = Http::withToken(env('GITHUB_OATH_T'))->get($endpoint, [
                'q'         => $query,
                'page'      => $initial_page,
                'per_page'  => $per_page,
            ]);

            if($response->ok()) {
                $links = ( new \TiagoHillebrandt\ParseLinkHeader($response->header('link')) )->toArray();
                
                GhRequest::create([
                    'endpoint'  => $endpoint,
                    'query'     => $query,
                    'per_page'  => $per_page,
                    'page'      => $initial_page,
                    'last'      => array_key_exists('last', $links) ? $links['last']['page'] : $initial_page
                ]);

                $collection = $collection->concat($response->collect()['items']);
                $initial_page++;
            }
        }
        
        if($collection->isNotEmpty())
            SaveGhUser::dispatch($collection)->onConnection('redis');

        return;
    }
}
