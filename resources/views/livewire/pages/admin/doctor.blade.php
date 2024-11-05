<div x-data="{ sidebarOpen: false, confirmDeleteVisible: false, doctorId: null }" class="relative flex h-screen bg-gray-100 overflow-hidden">
    <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        class="fixed inset-0 bg-white w-full h-full transform transition-transform duration-300 z-50 md:relative md:translate-x-0 md:w-64 md:h-auto md:flex md:flex-col">
        
        <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-gray-600 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <x-common.dashboard_nav />
    </div>

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <div class="relative w-60 h-40 bg-red-500 rounded-lg overflow-hidden">
                    <h3 class="text-center my-3 text-xl">Cantidad de doctores</h3>
                    <i class="absolute -left-7 -bottom-7 text-9xl text-red-900 w-1/6 fas fa-user-md"></i>
                    <h3 class="absolute right-4 bottom-4 text-5xl px-3 py-2 text-center text-gray-900">
                        {{ $count_doctors }}
                    </h3>
                </div>

                <div x-data="{ visible: false }">
                    <button @click="visible = true" class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Nuevo <i class="fas fa-plus-circle"></i>
                    </button>

                    <div x-show="visible" x-bind:style="{ display: visible ? 'flex' : 'none' }"
                        class="z-50 div_add fixed inset-0 flex items-center justify-center">
                        <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                            <i class="fas fa-times"></i>
                        </button>
                        <div :class="{ 'animated-div': visible }"
                            class="div_add__div w-4/6 min-h-[400px] bg-white rounded-lg">
                            <x-common.form_add_doctor :specialties="$specialties" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todos los médicos</h3>

                <div class="mt-4 mb-6">
                    <input wire:model.live="dniFilter" type="text" placeholder="Buscar por DNI"
                        class="w-full p-2 border border-gray-300 rounded-md">
                </div>

                <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    @if (count($doctors) > 0)
                        <thead class="text-xs text-white uppercase bg-red-600">
                            <tr>
                                <th scope="col" class="px-3 py-1 text-center">ID</th>
                                <th scope="col" class="px-3 py-1 text-center">Nombre</th>
                                <th scope="col" class="px-3 py-1 text-center">Especialidad</th>
                                <th scope="col" class="px-3 py-1 text-center">Teléfono</th>
                                <th scope="col" class="px-3 py-1 text-center">Dirección</th>
                                <th scope="col" class="px-3 py-1 text-center">Licencia</th>
                                <th scope="col" class="px-3 py-1 text-center">DNI</th>
                                <th scope="col" class="px-3 py-1 text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr class="bg-gray-200 border-b">
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->id }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->user->name }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->specialty->specialty }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->user->phone }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->user->address }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->license }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $doctor->user->dni }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        <a wire:navigate href="{{ route('edit.doctor', ['id' => $doctor->id]) }}"
                                            class="text-xl"><i class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                        <button @click="confirmDeleteVisible = true; doctorId = {{ $doctor->id }}" class="text-xl">
                                            <i class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tr>
                            <td colspan="8" class="text-gray-600 text-2xl text-center">No hay doctores registrados.</td>
                        </tr>
                    @endif
                </table>
            </div>
        </main>
    </div>


    <div x-show="confirmDeleteVisible" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
            <p class="mb-4">El doctor será eliminado</p>
            <button @click="confirmDeleteVisible = false; Livewire.dispatch('deleteConfirmed', { doctorId }); doctorId = null"
                    class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, eliminar</button>
            <button @click="confirmDeleteVisible = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>
</div>
