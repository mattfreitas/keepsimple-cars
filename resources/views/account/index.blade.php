<x-keepsimple-layout>
    <x-slot name="script">
        <script src="{{ url('js/global.js') }}"></script>
        <script src="{{ url('js/tips.js') }}"></script>
    </x-slot>

    <div class="container mx-auto flex flex-col">
        @if(session('message'))
            <div class="bg-green-50 p-3 text-green-700 mb-5">{{ session('message') }}</div>
        @endif

        <h1 class="text-6xl font-bold">Minha conta</h1>
        <p>Abaixo você poderá conferir todas as suas dicas.</p>

        @if ($errors->any())
            <div class="flex flex-col">
                <div class="font-bold">Ocorreram os seguintes erros:</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col space-y-4 pt-10">
            @forelse($tips as $tip)
                <div class="flex justify-between space-x-10 items-center border border-gray-100 p-5">
                    <div class="flex flex-col">
                        <a href="{{ route('tips.edit', $tip->id) }}" class="text-3xl font-medium hover:text-gray-500">{{ $tip->model_name }} <small class="font-normal text-base">{{ $tip->version_formatted }}</small></a>
                        <div class="flex flex-col py-2">
                            <div class="font-bold text-blue-500">{{ $tip->title }}</div>
                            <div class="text-slate-500">{{ $tip->description }}</div>
                        </div>
                        <small class="text-gray-400">Postado {{ $tip->created_at->format('d/m/Y') }}</small>
                    </div>
                    <div class="flex items-center space-x-2">
                        <form method="POST" action="{{ route('tips.destroy', $tip->id) }}">
                            <button class="py-2 px-5 border border-red-300 hover:text-red-600 hover:border-red-400 text-red-500 rounded">Apagar</button>
                            @method('delete')
                            @csrf
                        </form>
                        <a href="{{ route('tips.edit', $tip->id) }}" class="py-2 px-5 border border-slate-500 font-semibold bg-slate-500 hover:bg-slate-600 text-white rounded">Editar</a>
                    </div>
                </div>
            @empty
                <div>Parece que você ainda não escreveu nenhuma dica. <a href="{{ route('tips.create') }}" class="font-bold underline">Tente escrever uma nova dica aqui.</a></div>
            @endforelse
        </div>
    </div>
</x-keepsimple-layout>