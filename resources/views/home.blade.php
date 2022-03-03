<x-keepsimple-layout>
    <x-slot name="script">
        <script src="js/global.js"></script>
        <script src="js/filter.js"></script>
    </x-slot>

    <div class="container mx-auto flex flex-col">
        <h1 class="text-8xl font-bold tracking-tighter">Procure por dicas dos melhores veículos.</h1>

        <div class="flex justify-between items-center pt-5">
            <div class="flex text-3xl space-x-2 text-slate-700 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                <span>Últimas dicas</span>
            </div>

            <button id="openFilters" class="px-2 border border-gray-200 py-2 rounded hover:border-gray-300 hover:bg-gray-50 transition duration-200 flex space-x-1 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                </svg>

                <span class="text-sm font-bold text-slate-500">Ver filtros</span>
            </button>
        </div>

        <div class="pt-4 grid grid-cols-2 gap-5">
            @forelse($tips as $tip)
            <div class="flex justify-between flex-col p-5 border border-gray-200 max-w-2xl rounded space-y-2 hover:bg-gray-50 transition duration-200">
                <div class="flex flex-col space-y-2">
                    <div class="text-slate-500 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ $tip->user_name }}</span>
                    </div>
                    <div class="text-lg font-bold text-slate-500">
                        {{ $tip->make_name }} {{ $tip->model_name }} 
                        
                        @if(!$tip->is_for_all_versions) 
                            {{ $tip->model_version }} 
                        @else
                            <span class="inline-block bg-gray-50 rounded px-2 text-sm ml-1 font-normal">Todas as versões</span>
                        @endif
                    </div>
                    <div class="text-xl font-bold">
                        {{ $tip->title }}
                    </div>
                    <div class="text-slate-700">
                        {{ $tip->description }}
                    </div>
                </div>
                <small class="text-xs text-slate-700">Postado {{ $tip->created_at->format('d/m/Y H:i:s') }}</small>
            </div>
            @empty
                Não há dicas para os filtros especificados.
            @endforelse
        </div>

        <div class="flex justify-center space-x-2 mt-5">
            @if(!$tips->onFirstPage())
                <a href="{{ $tips->previousPageUrl() }}" class="border border-blue-500 text-blue-500 font-semibold px-3 py-2 rounded">Página anterior</a>
            @endif
            
            @if($tips->hasMorePages())
                <a href="{{ $tips->nextPageUrl() }}" class="bg-blue-500 text-white font-semibold px-3 py-2 rounded">Próxima página</a>
            @endif
        </div>
    </div>

    <div data-toggle="makeModelVersionFilter" id="overlay" class="hidden w-full h-full fixed top-0 left-0 z-10 bg-slate-500/50 backdrop-filter backdrop-blur"></div>
    <form data-toggle="makeModelVersionFilter" class="hidden w-full md:rounded space-y-2 shadow-2xl flex flex-col absolute mx-auto top-5 left-0 right-0 z-20 max-w-sm bg-white p-5">
        <div class="flex items-center font-semibold space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-300" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
            </svg>

            <span class="text-xl">Filtros</span>
        </div>

        <div class="flex flex-col space-y-1">
            <span class="font-medium text-gray-600">Tipo de veículo</span>
            <select name="vehicle_type" class="border-gray-200">
                <option value="">Todos os tipos</option>
                @foreach($vehicleTypes as $vehicleType)
                    <option value="{{ $vehicleType->id }}">{{ $vehicleType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col space-y-1">
            <span class="font-medium text-gray-600">Marca do veículo</span>
            <select name="make" class="border-gray-200">
                <option value="">Todas as marcas</option>
                @foreach($makes as $make)
                    <option value="{{ $make->id }}">{{ $make->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col space-y-1">
            <span class="font-medium text-gray-600 disabled:bg-gray-200">Modelo do veículo</span>
            <select name="model" class="border-gray-200 disabled:bg-gray-200" disabled>
                <option>Selecione uma marca</option>
            </select>
        </div>

        <div class="flex flex-col space-y-1">
            <span class="font-medium text-gray-600">Versão do veículo</span>
            <select name="version" class="border-gray-200 disabled:bg-gray-200" disabled>
                <option>Selecione um modelo</option>
            </select>
        </div>

        <button class="bg-blue-600 rounded py-3 text-white font-bold hover:bg-blue-700 transition duration-200 text-center">Filtrar resultados</button>
    </form>
</x-keepsimple-layout>