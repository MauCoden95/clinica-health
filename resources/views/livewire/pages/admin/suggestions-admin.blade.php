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
                <table class="min-w-full leading-normal">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Autor</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Asunto</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Descripción</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Fecha</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Hora</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Respuesta</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Útil</th>
                            <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($suggestions) > 0)
                        @foreach ($suggestions as $suggestion)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-300 ease-in-out">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $suggestion->user->name }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $suggestion->affair }}</td>
                            <td class="px-5 py-4 text-sm text-gray-900 max-w-xs">{{ $suggestion->description }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($suggestion->date)->format('d-m-Y') }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($suggestion->time)->format('H:i') }}</td>
                            <td class="px-5 py-4 text-sm text-gray-900 max-w-xs">
                                {{ $suggestion->response ?? 'Sin respuesta' }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-center text-sm">
                                <input type="checkbox" wire:click="toggleUseful({{ $suggestion->id }})" {{ $suggestion->useful == 1 ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-green-600 rounded-sm border-gray-300 focus:ring-green-500 transition duration-150 ease-in-out">
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium">
                                <button
                                    @click="
                                    replySuggestion = true;
                                    suggestionId = {{ $suggestion->id }};
                                    response = '{{ $suggestion->response }}';
                                    $nextTick(() => { $wire.suggestionId = suggestionId; $wire.response = response; });
                                "
                                    class="text-xl text-blue-600 hover:text-blue-400 duration-300">
                                    <i class="fas fa-comment"></i>
                                </button>
                                <button
                                    @click="confirmDelete = true, suggestionIdToDelete = {{ $suggestion->id }}"
                                    class="text-xl ml-4 text-red-600 hover:text-red-400 duration-300">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="px-5 py-4 text-center text-lg text-gray-600 dark:text-gray-400">
                                No hay quejas o sugerencias registradas.
                            </td>
                        </tr>
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