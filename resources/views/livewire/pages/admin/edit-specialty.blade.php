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
                    <h2 class="text-2xl font-semibold mb-6">Editar Especialidad</h2>
                    <a wire:navigate href="{{ route('admin.specialty') }}" class="text-xl">Volver a especialidades</a>
                </div>




                <script>
                    document.addEventListener('livewire:initialized', () => {
                        @this.on('editSpecialty', (data) => {
                            Swal.fire({
                                title: data[0].title,
                                text: data[0].text,
                                icon: data[0].type,
                                confirmButtonText: 'Aceptar'
                            });
                        });
                    });
                </script>
                <form wire:submit.prevent="editSpecialty" class="flex items-center justify-between gap-3">
                    <div class="w-3/6 mb-4">
                        <label for="specialty" class="block text-gray-700 font-bold mb-2">Especialidad</label>
                        <input type="text" id="specialty" wire:model="specialty"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <button type="submit"
                        class="w-3/6 h-12 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 duration-300">
                        Actualizar Especialidad
                    </button>


                </form>
            </div>






        </main>
    </div>
</div>
