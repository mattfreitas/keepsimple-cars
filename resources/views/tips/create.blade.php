<x-keepsimple-layout>
    <x-slot name="script">
        <script src="{{ url('js/global.js') }}"></script>
        <script src="{{ url('js/tips.js') }}"></script>
    </x-slot>

    <div class="container mx-auto flex flex-col">
        @if(session('message'))
            <div class="bg-green-50 p-3 text-green-700 mb-5">{{ session('message') }}</div>
        @endif

        <h1 class="text-6xl font-bold">Criar nova dica</h1>
        <p>Ajude pessoas do Brasil a escolher um carro com suas dicas.</p>

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
            <span class="text-lg text-slate-700 font-bold">Qual o tipo de veículo que você quer dar uma dica?</span>
            <div class="flex space-y-0 space-y-2 md:space-y-0 md:space-x-2">
                @foreach($vehicleTypes as $vehicleType)
                    <div data-vehicle-type="{{ $vehicleType->id }}" class="p-5 flex flex-col border rounded cursor-pointer hover:bg-gray-50">
                        <span class="font-semibold">{{ $vehicleType->name }}</span>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('tips.store') }}" class="flex flex-col space-y-4">
                <div class="flex flex-col space-y-1">
                    <span class="text-lg text-slate-700 font-bold">Qual a marca do veículo?</span>
                    <span class="text-slate-500">É importante para podermos apresentar os modelos para você.</span>
                    <select name="make_id" id="" class="max-w-md rounded border border-gray-200" required>
                        <option value="">Selecione um modelo</option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}">{{ $make->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="has-models hidden flex flex-col space-y-1">
                    <span class="text-lg text-slate-700 font-bold">E qual o modelo?</span>
                    <span class="text-slate-500">Caso não apareça um modelo disponível, experimente trocar a marca.</span>
                    <select name="model_id" id="" class="max-w-md rounded border border-gray-200" required>
                        <option value="">Selecione um modelo</option>
                    </select>
                </div>

                <div class="hasnt-models hidden bg-red-50 flex flex-col p-3 max-w-xs">
                    <span class="text-red-500 text-lg font-bold">Ops! Desculpa aí.</span>
                    <span class="text-red-500 text-sm">Parece que essa marca não possui modelos disponíveis. Tente trocar a marca.</span>
                </div>

                <div class="has-models hidden flex flex-col space-y-4">
                    <div class="flex flex-col space-y-1">
                        <span class="text-lg text-slate-700 font-bold">Qual seria a versão?</span>
                        <span class="text-slate-500">É opcional. Sua dica pode valer para qualquer versão do veículo. 😊</span>
                        <select name="version" id="" class="max-w-md rounded border border-gray-200">
                            <option value="">Todas as versões</option>
                        </select>
                    </div>
                </div>

                <div class="has-models hidden flex flex-col space-y-4">
                    <div class="flex flex-col space-y-1">
                        <span class="text-lg text-slate-700 font-bold">Escreva uma dica incrível</span>
                        <span class="text-slate-500">Essa dica vai ajudar motoristas a terem noção sobre o veículo.</span>
                        <input name="title" id="" class="py-3 px-2 input max-w-md rounded border border-gray-200" placeholder="Um título incrível pra sua dica."></input>
                        <textarea name="description" id="" cols="30" rows="6" class="max-w-md rounded border border-gray-200"></textarea>
                    </div>
                </div>

                <button class="max-w-md has-models hidden bg-blue-600 rounded py-3 text-white font-bold hover:bg-blue-700 transition duration-200 text-center">Escrever dica</button>
                @csrf
            </form>
        </div>
    </div>
</x-keepsimple-layout>