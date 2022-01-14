<?php

namespace App\Http\Livewire\GhUser;

use App\Models\GhUser;
use Livewire\Component;

class GhUserCreate extends Component
{
    public $login;
    public $gh_id;
    public $url;

    protected $rules = [
        'login' => 'required|unique:gh_users'
    ];

    public function create() 
    {
        $this->validate();

        GhUser::create([
            'login' => $this->login,
            'gh_id' => $this->gh_id,
            'url' => $this->url
        ]);

        session()->flash('message', 'Github User criado com sucesso!');

        $this->login = $this->gh_id = $this->url = null;
    }

    public function render()
    {
        return view('livewire.gh-user.gh-user-create');
    }
}
