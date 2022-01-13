<div class="max-w-7xl mx-auto py-10 px-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Criar Github User')}}
        </h2>
    </x-slot>

    @include('includes.message')

    <form action="" wire:submit.prevent="create" class="w-full max-w-7xl mx-auto">
        <div class="flex flex-wrap -mx-3 mb-6">
            <p class="w-full px-3 mb-6 md:mb-0">
                <label for="login" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Nome de Usuário</label>  
                <input type="text" name="login" class="block appearance-none w-full bg-gray-200 border @error('login') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="login">
                
                @error('login')
                    <h5 class="px-4 text-red-500 text-xs italic">{{$message}}</h5>
                @enderror   
            </p>
            <p class="w-full px-3 mb-6 md:mb-0">
                <label for="gh_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">ID do Github</label>  
                <input type="text" name="gh_id" class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="gh_id">
            </p>
            <p class="w-full px-3 mb-6 md:mb-0">
                <label for="url" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Url do Github</label>  
                <input type="text" name="url" class="block appearance-none w-full bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="url">
            </p>
        </div>
        <div class="w-full py-4 px-3 mb-6 md:mb-0">
            <button type="submit" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Criar Github User</button>
        </div>
    </form>
</div>
