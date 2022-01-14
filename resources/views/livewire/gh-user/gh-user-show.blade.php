<div class="max-w-7xl mx-auto py-10 px-4">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Github User '.$gh_user->login)}}
        </h2>
    </x-slot>

    <div class="w-full mx-auto text-right mb-4">
        <a href="{{route('gh_users.index')}}" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">Voltar</a>
    </div>

    <table class="table-auto w-full mx-auto">
        <thead>
            <tr class="text-left">
                <th class="px-4 py-2">Git #</th>
                <th class="px-4 py-2">URL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-4 py-2 border">{{$gh_user->gh_id}}</td>
                <td class="px-4 py-2 border">{{$gh_user->url}}</td>
            </tr>
        </tbody>
    </table>
</div>