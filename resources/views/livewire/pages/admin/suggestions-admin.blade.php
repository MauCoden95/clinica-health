<div x-data="{ sidebarOpen: false, replySuggestion: false, confirmDelete: false, suggestionIdToDelete: null, editSpecialtyModal: false, suggestionId: null, response: '' }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <x-common.count :item="'Cantidad de quejas/sugerencias'" :quantity="$count_suggestions" :icon="'fas fa-comment'" />



            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todas las quejas/sugerencias</h3>


                <span class="">
                    Ver Quejas/sugerencias marcadas
                    <input class="ml-2" type="checkbox" wire:model="showUsefuls" wire:change="showUsefulsSuggestions">
                </span>
                <table class="w-full m-auto mt-6 mb-20 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    @if (count($suggestions) > 0)
                    <thead class="text-xs text-white uppercase bg-red-600 ">
                        <tr>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Autor</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Asunto</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Descripcion</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Fecha</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Hora</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Respuesta</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Marcar</th>
                            <th scope="col" class="px-3 py-1 text-center border border-black">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($suggestions as $suggestion)
                        <tr class="bg-gray-200 border-b ">
                            <td class="px-3 py-2 text-center text-gray-900 border border-black">{{ $suggestion->user->name }}</td>
                            <td class="px-3 py-2 text-center text-gray-900 border border-black">{{ $suggestion->affair }}</td>
                            <td class="px-3 py-2 text-center text-gray-900 border border-black">{{ $suggestion->description }}</td>
                            <td class="mx-14 text-center text-gray-900 border border-black">{{ \Carbon\Carbon::parse($suggestion->date)->format('d-m-Y') }}</td>
                            <td class="mx-14 text-center text-gray-900 border border-black">{{ \Carbon\Carbon::parse($suggestion->time)->format('H:i') }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ $suggestion->response ?? 'Sin respuesta' }}
                            </td>
                            <td class="mx-14 text-center text-gray-900 border border-black">
                                {{--<button wire:click="toggleUseful({{ $suggestion->id }})">ssss</button>--}}
                                <input type="checkbox" wire:click="toggleUseful({{ $suggestion->id }})" {{ $suggestion->useful == 1 ? 'checked' : '' }}>
                            </td>

                            <td class="px-3 py-2 text-center text-gray-900">
                                <button @click="
                                    replySuggestion = true;
                                    suggestionId = {{ $suggestion->id }};
                                    response = '{{ $suggestion->response }}';
                                    $nextTick(() => { $wire.suggestionId = suggestionId; $wire.response = response; });
                                "><i class="fas fa-comment text-xl text-blue-500 hover:text-blue-700"></i></button>
                                <button @click="confirmDelete = true, suggestionIdToDelete = {{ $suggestion->id }}"><i class="fas fa-trash ml-4 text-xl text-red-500 hover:text-red-700"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p class="text-gray-600 text-2xl">No hay quejas/sugerencias registradas.</p>
                        @endif
                    </tbody>
                </table>
            </div>

            <div x-show="confirmDelete"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-5">
                    <h3 class="text-lg font-bold">¿Estás seguro?</h3>
                    <p class="mt-2">La especialidad será eliminada.</p>
                    <div class="flex justify-between mt-4">
                        <button @click="confirmDelete = false"
                            class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancelar</button>
                        <button @click="$wire.deleteConfirmed(suggestionIdToDelete); confirmDelete = false"
                            class="px-4 py-2 bg-red-600 text-white rounded">Eliminar</button>
                    </div>
                </div>
            </div>




            {{-- Modal para editar especialidad --}}
            <div x-show="editSpecialtyModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="w-3/6 bg-white p-6 rounded-lg text-center">
                    <button @click="editSpecialtyModal = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                        <i class="fas fa-times"></i>
                    </button>
                    <form wire:submit.prevent="editSpecialty">
                        <h3 class="my-4 text-center text-xl">Editar especialidad</h3>



                        <input type="text" id="specialty" wire:model.defer="specialty" x-model="specialty" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                        <span x-text="suggestionId"></span>




                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 duration-300 m-auto mt-8 text-black hover:text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Guardar
                            </button>
                        </div>
                    </form>


                </div>
            </div>


        </main>

        <div x-show="confirmDelete"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-5">
                <h3 class="text-lg font-bold">¿Estás seguro?</h3>
                <p class="mt-2">La queja/sugerencia será eliminada.</p>
                <div class="flex justify-between mt-4">
                    <button @click="confirmDelete = false"
                        class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancelar</button>
                    <button @click="$wire.deleteConfirmed(suggestionIdToDelete); confirmDelete = false"
                        class="px-4 py-2 bg-red-600 text-white rounded">Eliminar</button>
                </div>
            </div>
        </div>


        <div x-show="replySuggestion"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="max-w-[500px] bg-white rounded-lg p-5">
                <h3 class="text-lg font-bold text-center">Responder queja/sugerencia</h3>
                <div class="mt-4">
                    <form wire:submit.prevent="replySuggestion">
                        <textarea id="response" rows="8" cols="30" wire:model.defer="response" x-model="response" class="w-5/6 h-96 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>


                        <button
                            type="submit"
                            class="w-full mt-5 mr-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-black rounded">Responder</button>

                        <button @click="replySuggestion = false" type="button"
                            class="w-full mt-5 mr-2 px-4 py-2 bg-gray-400 hover:bg-gray-500 text-black rounded">Cerrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>