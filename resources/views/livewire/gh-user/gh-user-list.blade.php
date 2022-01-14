<div class="max-w-7xl mx-auto py-10 px-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Lista Github User')}}
        </h2>
    </x-slot>

    <div class="w-full mx-auto text-right mb-4">
        <a href="{{route('gh_users.create')}}" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Criar Github User</a>
    </div>
    <div class="w-full mx-auto text-right mb-4">
        <input type="text" wire:model="searchTerm" class="appearance-none bg-gray-200 border text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="procurar por login" />
    </div>

    @include('includes.message')

    <table class="table-auto w-full mx-auto">
        <thead>
            <tr class="text-left">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Login</th>
                <th class="px-4 py-2">ID Github</th>
                <th class="px-4 py-2">URL</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Criação</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gh_users as $item)
            <tr>
                <td class="px-4 py-2 border">{{$item->id}}</td>
                <td class="px-4 py-2 border">{{$item->login}}</td>
                <td class="px-4 py-2 border">{{$item->gh_id}}</td>
                <td class="px-4 py-2 border">{{$item->url}}</td>
                <td class="px-4 py-2 border"><span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 {{ $item->trashed() ? 'bg-orange-500 line-through' : 'bg-teal-500' }} rounded-full">OK</span></td>
                <td class="px-4 py-2 border">{{$item->created_at->diffForHumans()}}</td>
                <td class="px-4 py-2 border">
                    <div class="inline-flex">
                        <a href="{{route('gh_users.show', $item->id)}}" class="px-4 py-2 border rounded bg-blue-500 text-white">Visualizar</a>
                        <a href="{{route('gh_users.edit', $item->id)}}" class="px-4 py-2 border rounded bg-orange-500 text-white">Editar</a>
                        @if ($item->trashed())
                            <a href="#" wire:click.prevent='restore({{$item->id}})' class="px-4 py-2 border rounded bg-indigo-500 text-white">Restaurar</a>
                            <a href="#" wire:click.prevent='remove({{$item->id}})' class="px-4 py-2 border rounded bg-red-500 text-white">Remover</a>
                        @else
                            <a href="#" wire:click.prevent='delete({{$item->id}})' class="px-4 py-2 border rounded bg-red-500 text-white">Deletar</a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-full mx-auto mt-10">
        {{ $gh_users->links() }}
    </div>
</div>
