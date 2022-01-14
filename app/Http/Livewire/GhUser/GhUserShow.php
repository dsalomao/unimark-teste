<?php

namespace App\Http\Livewire\GhUser;

use App\Models\GhUser;
use Livewire\Component;

class GhUserShow extends Component
{
    public GhUser $gh_user;

    public function mount(GhUser $gh_user)
    {

    }
    
    public function render()
    {
        return view('livewire.gh-user.gh-user-show');
    }
}
