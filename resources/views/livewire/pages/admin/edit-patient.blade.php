<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 overflow-hidden">

    
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


        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full mx-auto mt-8 px-14 py-10 bg-gray-100 rounded-lg shadow-md">
                <div class="w-full flex justify-between">
                    <h2 class="text-2xl font-semibold mb-6">Editar Paciente</h2>
                    <a wire:navigate href="{{ route('admin.pacientes') }}" class="text-xl">Volver a pacientes</a>
                </div>




                <script>
                    document.addEventListener('livewire:initialized', () => {
                        @this.on('editUser', (data) => {
                            Swal.fire({
                                title: data[0].title,
                                text: data[0].text,
                                icon: data[0].type,
                                confirmButtonText: 'Aceptar'
                            });
                        });
                    });
                </script>
                <form wire:submit.prevent="editPatient" class="grid grid-cols-2 gap-3">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Nombre</label>
                        <input type="text" id="name" wire:model="name"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" wire:model="email"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Dirección</label>
                        <input type="text" id="address" wire:model="address"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">Teléfono</label>
                        <input type="text" id="phone" wire:model="phone"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 font-bold mb-2">DNI</label>
                        <input type="text" id="dni" wire:model="dni"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mb-4">
                        <label for="obra_social" class="block text-gray-700 font-bold mb-2">Obra Social</label>
                        <input type="text" id="obra_social" wire:model="obra_social"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>


                    <div class="mt-6">
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 duration-300">
                            Actualizar Paciente
                        </button>
                    </div>
                </form>
            </div>




        </main>
    </div>
</div>
