<?php

namespace App\Console\Commands;

use App\Models\GhUser;
use Illuminate\Console\Command;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Http;

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Github $hub)
    {
        GhUser::truncate();

        $collection = collect();
        $i = 1;

        while ($i <= 3) { 
            $collection = $collection->concat(Http::withToken(env('GITHUB_OATH_T'))->get('https://api.github.com/search/users', [
                'q'         => 'type:"user" language:"php" language:"laravel" repos:>1 location:"brasil" location:"brazil"',
                'page'      => $i,
                'per_page'  => 100,
            ])->collect()['items']);
            $i++;
        }

        dd($collection);
    }
}
