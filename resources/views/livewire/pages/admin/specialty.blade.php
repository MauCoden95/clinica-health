<div x-data="{ sidebarOpen: false, confirmDelete: false, specialtyIdToDelete: null, editSpecialtyModal: false, specialtyId: null, specialty: '' }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-10 flex justify-between">
                <div class="flex">
                    <x-common.count :item="'Cantidad de especialidades'" :quantity="$count_specialties" :icon="'fas fa-user-md'" />

                </div>



                <div x-data="{ visible: false }">
                    <button @click="visible = true"
                        class="flex items-center justify-center space-x-2 
               px-6 py-3 text-white font-semibold 
               bg-green-600 rounded-lg shadow-lg 
               hover:bg-green-700 hover:shadow-xl 
               focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 
               transition duration-300 transform hover:scale-105">
                        <i class="fas fa-plus-circle text-lg"></i>
                        <span>Nueva especialidad</span>
                    </button>

                    <div x-show="visible" class="z-50 div_add fixed inset-0 flex items-center justify-center">
                        <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                            <i class="fas fa-times"></i>
                        </button>
                        <div :class="{ 'animated-div': visible }" class="div_add__div w-4/6 min-h-[100px] bg-white rounded-lg">
                            <x-common.form_add_specialty />
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 mb-5 font-bold">Todas las especialidades</h3>

                <div class="overflow-x-auto rounded-lg shadow-md">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                        @if (count($specialties) > 0)
                        @foreach ($specialties as $specialty)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $specialty->specialty }}</h3>
                            </div>
                            <div class="flex justify-end mt-4 space-x-2">
                                <button
                                    @click="
                            editSpecialtyModal = true;
                            specialtyId = {{ $specialty->id }};
                            specialty = '{{ $specialty->specialty }}';
                            $nextTick(() => { $wire.specialtyId = specialtyId; $wire.specialty = specialty; });
                        "
                                    class="text-xl text-blue-600 hover:text-blue-400 duration-300">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button
                                    @click="confirmDelete = true; specialtyIdToDelete = {{ $specialty->id }}"
                                    class="text-xl text-red-600 hover:text-red-400 duration-300">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center text-gray-600 dark:text-gray-400 py-10">
                            <p class="text-2xl font-semibold">No hay especialidades registradas.</p>
                        </div>
                        @endif
                    </div>
                </div>
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




            {{-- Modal para editar especialidad --}}
            <div x-show="editSpecialtyModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="w-3/6 bg-white p-6 rounded-lg text-center">
                    <button @click="editSpecialtyModal = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                        <i class="fas fa-times"></i>
                    </button>
                    <form wire:submit.prevent="editSpecialty(specialty)">
                        <h3 class="my-4 text-center text-xl">Editar especialidad</h3>



                        <input type="text" id="specialty" wire:model.defer="specialty" x-model="specialty" class="mb-5 shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">






                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 duration-300 m-auto mt-8 text-black hover:text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Guardar
                            </button>
                        </div>
                    </form>


                </div>
            </div>


            <div class="px-14 my-6">
                <form class="mt-24 flex flex-col" action="{{ route('import-specialties') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('success'))
                    <div class="bg-green-400 text-green-800 p-4 rounded-md mb-6">
                        {{ session('success') }}
                    </div>
                    @elseif (session()->has('error'))
                    <div class="bg-red-400 text-red-800 p-4 rounded-md mb-6">
                        <p>¡Error al importar especialidades!</p>
                    </div>
                    @endif
                    <h2 class="text-2xl font-bold mb-6">Importar y exportar especialidades</h2>
                    <input type="file" name="excel_file" required>
                    <div class="w-2/5 flex items-center justify-between">
                        <button class="w-2/4 mt-6 mr-2 bg-red-500 hover:bg-red-600 duration-300 text-white px-5 py-2" type="submit">Importar</button>
                        <a href="{{ route('export-specialties') }}" class="block w-2/4 mt-6 bg-yellow-500 hover:bg-yellow-600 duration-300 text-white px-5 py-2 text-center">Exportar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>