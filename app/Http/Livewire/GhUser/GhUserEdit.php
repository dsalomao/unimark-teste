<?php

namespace App\Http\Livewire\GhUser;

use App\Models\GhUser;
use Livewire\Component;

class GhUserEdit extends Component
{
    public GhUser $gh_user;

    public function mount(/*GhUser $gh_user*/)
    {
        $this->id = $this->gh_user->id;
        $this->login = $this->gh_user->login;
        $this->gh_id = $this->gh_user->gh_id;
        $this->url = $this->gh_user->url;
    }

    public function update()
    {
        $this->validate([
            'login' => 'required|unique:gh_users,login,'.$this->id
        ]);

        $this->gh_user->update([
            'login' => $this->login,
            'gh_id' => $this->gh_id,
            'url'   => $this->url
        ]);

        session()->flash('message', 'Github User atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.gh-user.gh-user-edit');
    }
}
