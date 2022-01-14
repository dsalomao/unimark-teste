<?php

namespace App\Http\Livewire\GhUser;

use App\Models\GhUser;
use Livewire\Component;

class GhUserList extends Component
{
    public function render()
    {
        $gh_users = GhUser::withTrashed()->paginate(10);

        return view('livewire.gh-user.gh-user-list', compact('gh_users'));
    }

    public function delete($gh_user)
    {
        $gh_user = GhUser::find($gh_user);
        $gh_user->delete();

        session()->flash('message', 'Usuário do git deletado com sucesso!');
    }
    
    public function remove($gh_user)
    {
        $gh_user = GhUser::withTrashed()->find($gh_user);
        $gh_user->forceDelete();

        session()->flash('message', 'Usuário do git removido com sucesso!');
    }
    
    public function restore($gh_user)
    {
        $gh_user = GhUser::withTrashed()->find($gh_user);
        $gh_user->restore();

        session()->flash('message', 'Usuário do git restaurado com sucesso!');
    }
}
