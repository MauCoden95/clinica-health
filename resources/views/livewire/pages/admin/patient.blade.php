<div x-data="{ sidebarOpen: false, deleteModalOpen: false, patientIdToDelete: null }" class="flex h-screen bg-gray-100 overflow-hidden">

    
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
                    <h3 class="text-center my-3 text-xl">Cantidad de pacientes</h3>
                    <i class="absolute -left-7 -bottom-7 text-9xl text-red-900 w-1/6 fas fa-user-md"></i>
                    <h3 class="absolute right-4 bottom-4 text-5xl px-3 py-2 text-center text-gray-900">
                        {{ $count_patients }}
                    </h3>
                </div>
                <div x-data="{ visible: false }">
                    <button @click="visible = true" class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Nuevo <i class="fas fa-plus-circle"></i>
                    </button>
                    <div x-show="visible" x-bind:style="{ display: visible ? 'flex' : 'none' }" class="z-50 div_add fixed inset-0 flex items-center justify-center">
                        <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                            <i class="fas fa-times"></i>
                        </button>
                        <div :class="{ 'animated-div': visible }" class="div_add__div w-4/6 min-h-[400px] bg-white rounded-lg">
                            <x-common.form_add_patient />
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="relative w-full px-14 overflow-x-auto mb-7 ">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todos los pacientes</h3>

                <div class="mt-4 mb-6">
                    <input wire:model.live="dniFilter" type="text" placeholder="Buscar por DNI" class="w-full p-2 border border-gray-300 rounded-md">
                </div>

                <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    @if (count($patients) > 0)
                        <thead class="text-xs text-white uppercase bg-red-600 ">
                            <tr>
                                <th class="px-3 py-1 text-center">Nombre</th>
                                <th class="px-3 py-1 text-center">Email</th>
                                <th class="px-3 py-1 text-center">Teléfono</th>
                                <th class="px-3 py-1 text-center">Dirección</th>
                                <th class="px-3 py-1 text-center">DNI</th>
                                <th class="px-3 py-1 text-center">Obra Social</th>
                                <th class="px-3 py-1 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr class="bg-gray-200 border-b">
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $patient->name }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $patient->email }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $patient->phone }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $patient->address }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $patient->dni }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">{{ $patient->obra_social }}</td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        <a wire:navigate href="{{ route('edit.patient', ['id' => $patient->id]) }}" class="text-xl"><i class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                        <button @click="deleteModalOpen = true; patientIdToDelete = {{ $patient->id }}" class="text-xl">
                                            <i class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-2xl">No hay pacientes registrados.</p>
                    @endif
                    </tbody>
                </table>
            </div>

           
            <div x-show="deleteModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
                    <p class="text-gray-700 mb-6">El paciente será eliminado de forma permanente.</p>
                    <div class="flex justify-end">
                        <button @click="deleteModalOpen = false" class="px-4 py-2 mr-2 bg-gray-300 hover:bg-gray-400 rounded">Cancelar</button>
                        <button @click="Livewire.dispatch('deleteConfirmed', { patientId: patientIdToDelete }); deleteModalOpen = false;" class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded">Eliminar</button>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
