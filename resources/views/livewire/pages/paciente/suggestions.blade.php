<div x-data="{ sidebarOpen: false, confirmDeleteVisible: false, showModal: false, suggestionId: null }" class="relative flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />




    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />


        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 m-auto overflow-x-auto mt-20">
                <div class="flex justify-between">
                    <div class="relative w-full overflow-x-auto flex justify-between">
                        <x-common.count :item="'Quejas o sugerencias realizadas'" :quantity="$count_suggestions" :icon="'fas fa-comment'" />
                    </div>


                    <div x-data="{ visible: false }">
                        <button @click="visible = true" class="flex items-center btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                            Nuevo <i class="fas fa-plus-circle ml-3"></i>
                        </button>

                        <div x-show="visible" x-bind:style="{ display: visible ? 'flex' : 'none' }"
                            class="z-50 div_add fixed inset-0 flex items-center justify-center">
                            <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                                <i class="fas fa-times"></i>
                            </button>
                            <div :class="{ 'animated-div': visible }"
                                class="div_add__div w-4/6 min-h-[400px] bg-white rounded-lg">
                                <x-common.form_add_suggestion />
                            </div>
                        </div>
                    </div>
                </div>





                <table class="w-full m-auto my-20 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-red-600">
                        <tr>
                            <th scope="col" class="px-3 py-1 text-center">Asunto</th>
                            <th scope="col" class="px-3 py-1 text-center">Descripcion</th>
                            <th scope="col" class="px-3 py-1 text-center">Fecha</th>
                            <th scope="col" class="px-3 py-1 text-center">Hora</th>
                            <th scope="col" class="px-3 py-1 text-center">Respuesta</th>
                            <th scope="col" class="px-3 py-1 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($suggestions as $suggestion)
                        <tr class="bg-gray-200 border-b">
                            <td class="px-3 py-2 text-center text-gray-900">{{ $suggestion->affair }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $suggestion->description }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ \Carbon\Carbon::parse($suggestion->date)->format('d-m-Y') }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ \Carbon\Carbon::parse($suggestion->time)->format('H:i') }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ $suggestion->response ?? 'Sin respuesta' }}
                            </td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                <a>
                                    <i class="fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                                </a>
                                <button @click="confirmDeleteVisible = true; suggestionId = {{ $suggestion->id }}">
                                    <i class="fas fa-trash ml-3 text-xl text-red-600 hover:text-red-400 duration-300"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr class="">
                            <td colspan="6" class="text-gray-600 text-xl text-center">No hay sugerencias registradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>



            </div>






        </main>
    </div>


    {{-- Modal para confirmar eliminacion de queja o sugerencia --}}
    <div x-show="confirmDeleteVisible" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
            <p class="mb-4">La queja/sugerencia será eliminada</p>
            <button @click="confirmDeleteVisible = false; Livewire.dispatch('deleteConfirmed', { suggestionId }); suggestionId = null"
                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, eliminar</button>
            <button @click="confirmDeleteVisible = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>


</div>