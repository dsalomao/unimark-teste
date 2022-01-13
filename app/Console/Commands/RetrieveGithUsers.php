<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GrahamCampbell\GitHub\Facades\GitHub;

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
        echo var_dump(GitHub::search()->users(['q' => 'type:user location:brasil location:brazil repos:>1 language:php language:laravel', 'per_page' => 100]));
    }
}
