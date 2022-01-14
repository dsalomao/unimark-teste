<?php

namespace App\Jobs;

use App\Jobs\Middleware\RateLimited;
use App\Models\GhUser;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class SaveGhUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The GithubUser instance.
     *
     * @var \App\Models\GhUser
     */
    protected $user;

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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            GhUser::create([
                'login'     =>  $user['login'],
                'gh_id'     =>  $user['id'],
                'url'       =>  $user['url']
            ]);
        }
    }
}
