<div x-data="{ sidebarOpen: false, confirmDelete: false, specialtyIdToDelete: null }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <x-common.count :item="'Cantidad de especialidades'" :quantity="$count_specialties" :icon="'fas fa-user-md'" />


                <div x-data="{ visible: false }">
                    <button @click="visible = true"
                        class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Nuevo <i class="fas fa-plus-circle"></i>
                    </button>

                    <div x-show="visible" class="z-50 div_add fixed inset-0 flex items-center justify-center">
                        <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="div_add__div w-4/6 min-h-[100px] bg-white rounded-lg">
                            <x-common.form_add_specialty />
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todas las especialidades</h3>

                <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    @if (count($specialties) > 0)
                        <thead class="text-xs text-white uppercase bg-red-600 ">
                            <tr>
                                <th scope="col" class="px-3 py-1 text-xl text-center">ID</th>
                                <th scope="col" class="w-3/5 px-3 py-1 text-xl text-center">Especialidad</th>
                                <th scope="col" class="px-3 py-1 text-xl text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($specialties as $specialty)
                                <tr class="bg-gray-200 border-b ">
                                    <td class="px-3 py-2 text-center text-xl text-gray-900">{{ $specialty->id }}</td>
                                    <td class="px-3 py-2 text-center text-xl text-gray-900">{{ $specialty->specialty }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-xl text-gray-900">
                                        <a wire:navigate href="{{ route('edit.specialty', ['id' => $specialty->id]) }}"
                                            class="text-xl"><i
                                                class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                        <button
                                            @click="confirmDelete = true; specialtyIdToDelete = {{ $specialty->id }}"
                                            class="text-xl">
                                            <i
                                                class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-2xl">No hay doctores registrados.</p>
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
                        <button @click="$wire.deleteConfirmed(specialtyIdToDelete); confirmDelete = false"
                            class="px-4 py-2 bg-red-600 text-white rounded">Eliminar</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
