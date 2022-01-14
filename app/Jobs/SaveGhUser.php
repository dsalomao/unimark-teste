<?php

namespace App\Jobs;

use App\Models\GhUser;
use ErrorException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class SaveGhUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The GithubUser instance.
     *
     * @var \App\Models\GhUser
     */
    protected $users;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job. Job for saving in the DB the 300 programmers max. alocated to it by the command 
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            $validator = FacadesValidator::make($user, [
                'login'     =>  'required',
                'id'     =>  'required',
                'url'       =>  'required'
            ]);

            if(!$validator->fails()) {
                GhUser::create([
                    'login'     =>  $user['login'],
                    'gh_id'     =>  $user['id'],
                    'url'       =>  $user['url']
                ]);
            }
        }
    }
}
