<div x-data="{ sidebarOpen: false, deleteModalOpen: false, patientIdToDelete: null, editPatientModal: false, patientId: null, name: '', email: '', phone: 0, address: '', dni: 0, obra_social: '' }" class="flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">


            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">

                <x-common.count :item="'Cantidad de pacientes'" :quantity="$count_patients" :icon="'fas fa-user'" />

                <div x-data="{ visible: false }">
                    <button @click="visible = true"
                        class="flex items-center justify-center space-x-2 
               px-6 py-3 text-white font-semibold 
               bg-green-600 rounded-lg shadow-lg 
               hover:bg-green-700 hover:shadow-xl 
               focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 
               transition duration-300 transform hover:scale-105">
                        <i class="fas fa-plus-circle text-lg"></i>
                        <span>Nuevo paciente</span>
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

                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table class="min-w-full leading-normal">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Nombre
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Email
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Teléfono
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Dirección
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    DNI
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Obra Social
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($patients) > 0)
                            @foreach ($patients as $patient)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-300 ease-in-out">
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->name }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->email }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->phone }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->address }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->dni }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $patient->obra_social }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm font-medium">
                                    <button @click="
                            editPatientModal = true;
                            patientId = {{ $patient->id }};
                            name = '{{ $patient->name }}';
                            email = '{{ $patient->email }}';
                            phone = {{ $patient->phone }};
                            address = '{{ $patient->address }}';
                            dni = {{ $patient->dni }};
                            obra_social = '{{ $patient->obra_social }}';
                            $nextTick(() => { 
                                $wire.patientId = patientId; 
                                $wire.name = name; 
                                $wire.email = email; 
                                $wire.phone = phone; 
                                $wire.address = address; 
                                $wire.dni = dni; 
                                $wire.obra_social = obra_social; 
                            });" class="text-xl text-blue-600 hover:text-blue-400 duration-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="deleteModalOpen = true; patientIdToDelete = {{ $patient->id }}" class="text-xl ml-2 text-red-600 hover:text-red-400 duration-300">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="px-5 py-4 text-center text-lg text-gray-600 dark:text-gray-400">
                                    No hay pacientes registrados.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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


            {{-- Modal para editar sugerencia --}}
            <div x-show="editPatientModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="w-3/6 bg-white p-6 rounded-lg text-center">
                    <button @click="editPatientModal = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                        <i class="fas fa-times"></i>
                    </button>
                    <form wire:submit.prevent="editPatient">
                        <h3 class="my-4 text-center text-xl">Editar paciente</h3>



                        <input type="text" id="name" wire:model.defer="name" x-model="name" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nombre">

                        <input type="email" id="email" wire:model.defer="email" x-model="email" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Email">

                        <input type="text" id="phone" wire:model.defer="phone" x-model="phone" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Teléfono">

                        <input type="text" id="address" wire:model.defer="address" x-model="address" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Dirección">

                        <input type="number" id="dni" wire:model.defer="dni" x-model="dni" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="DNI">

                        <input type="text" id="obra_social" wire:model.defer="obra_social" x-model="obra_social" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Obra Social">





                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 duration-300 m-auto mt-8 text-black hover:text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Guardar
                            </button>
                        </div>
                    </form>


                </div>
            </div>

        </main>
    </div>
</div>