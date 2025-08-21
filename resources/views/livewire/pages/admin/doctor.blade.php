<div x-data="{ sidebarOpen: false, confirmDeleteVisible: false, doctorId: null }" class="relative flex h-screen bg-gray-100 overflow-hidden">
    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">

                <x-common.count :item="'Cantidad de doctores'" :quantity="$count_doctors" :icon="'fas fa-user-md'" />

                <div x-data="{ visible: false }">
                    <button @click="visible = true"
                        class="flex items-center justify-center space-x-2 
               px-6 py-3 text-white font-semibold 
               bg-green-600 rounded-lg shadow-lg 
               hover:bg-green-700 hover:shadow-xl 
               focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 
               transition duration-300 transform hover:scale-105">
                        <i class="fas fa-plus-circle text-lg"></i>
                        <span>Nuevo médico</span>
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

                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table class="min-w-full leading-normal">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    ID
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Nombre
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Especialidad
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Teléfono
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Dirección
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Licencia
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    DNI
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($doctors) > 0)
                            @foreach ($doctors as $doctor)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-300 ease-in-out">
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->id }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->user->name }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->specialty->specialty }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->user->phone }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->user->address }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->license }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $doctor->user->dni }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm font-medium">
                                    <a wire:navigate href="{{ route('edit.doctor', ['id' => $doctor->id]) }}"
                                        class="text-xl text-blue-600 hover:text-blue-400 duration-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a wire:navigate href="{{ route('edit.doctor_schedule', ['id' => $doctor->id]) }}"
                                        title="Modificar dia de trabajo"
                                        class="text-xl ml-4 text-orange-700 hover:text-orange-400 duration-300">
                                        <i class="fas fa-calendar-alt"></i>
                                    </a>
                                    <button @click="confirmDeleteVisible = true; doctorId = {{ $doctor->id }}"
                                        class="text-xl ml-4 text-red-600 hover:text-red-400 duration-300">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="px-5 py-4 text-center text-lg text-gray-600 dark:text-gray-400">
                                    No hay doctores registrados.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>





    {{-- Modal para confirmar eliminacion de medico --}}
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