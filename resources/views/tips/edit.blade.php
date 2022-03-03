<x-keepsimple-layout>
    <div class="container mx-auto flex flex-col">
        @if(session('message'))
            <div class="bg-green-50 p-3 text-green-700 mb-5">{{ session('message') }}</div>
        @endif

        <h1 class="text-6xl font-bold">Editar dica</h1>
        <p>Atualize sua dica para visitantes de todo Brasil.</p>

        @if ($errors->any())
            <div class="pt-5">
                <div class="flex flex-col p-5 bg-red-50">
                    <div class="font-bold text-red-500">Ocorreram os seguintes erros:</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="flex flex-col space-y-4 pt-5">
            <span class="text-lg text-slate-700 font-bold">Tipo de veículo</span>
            <div class="flex space-y-0 space-y-2 md:space-y-0 md:space-x-2">
                @foreach($vehicleTypes as $vehicleType)
                    <div class="@if($tip->model->vehicle_type_id == $vehicleType->id) active-vehicle-type cursor-pointer @else bg-gray-100 @endif p-5 flex flex-col border rounded">
                        <span class="font-semibold">{{ $vehicleType->name }}</span>
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('tips.update', $tip->id) }}" class="flex flex-col space-y-4">
                <div class="flex flex-col space-y-1">
                    <span class="text-lg text-slate-700 font-bold">Marca do veículo</span>
                    <input name="make_id" class="hidden" type="hidden" value="{{ $tip->model->make->id }}">
                    <input class="py-3 px-2 input max-w-md rounded border border-gray-200 bg-gray-100" disabled value="{{ $tip->model->make->name }}">
                </div>

                <div class="has-models flex flex-col space-y-1">
                    <span class="text-lg text-slate-700 font-bold">Modelo</span>
                    <input name="model_id" class="hidden" type="hidden" value="{{ $tip->model->id }}">
                    <input class="py-3 px-2 input max-w-md rounded border border-gray-200 bg-gray-100" disabled value="{{ $tip->model->name }}">
                </div>

                <div class="has-models flex flex-col space-y-4">
                    <div class="flex flex-col space-y-1">
                        <span class="text-lg text-slate-700 font-bold">Qual seria a versão?</span>
                        <span class="text-slate-500">Sua dica pode valer para qualquer versão do veículo. 😊</span>
                        <select name="version" id="" class="max-w-md rounded border border-gray-200">
                            <option @if($tip->is_for_all_versions) selected @endif value="">Todas as versões</option>
                            @foreach($tip->model->getAllVersionByModelId($tip->model_id) as $version)
                                <option 
                                    @if(!$tip->is_for_all_versions && $tip->model_id == $version->id) selected @endif 
                                    value="{{ $version->id }}">
                                    {{ $version->version }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="has-models flex flex-col space-y-4">
                    <div class="flex flex-col space-y-1">
                        <span class="text-lg text-slate-700 font-bold">Sua dica incrível</span>
                        <span class="text-slate-500">Você pode editar o título e a descrição da sua dica :)</span>
                        <input name="title" id="" class="py-3 px-2 input max-w-md rounded border border-gray-200" placeholder="Um título incrível pra sua dica." value="{{ $tip->title }}"></input>
                        <textarea name="description" id="" cols="30" rows="6" class="max-w-md rounded border border-gray-200">{{ $tip->description }}</textarea>
                    </div>
                </div>

                <button class="max-w-md has-models bg-blue-600 rounded py-3 text-white font-bold hover:bg-blue-700 transition duration-200 text-center">Atualizar dica</button>
                @csrf
                @method('patch')
            </form>
        </div>
    </div>
</x-keepsimple-layout>