<div class="relative flex">
    <div class="div_add z-50 absolute top-0 left-0 right-0 bottom-0 w-screen h-screen flex items-center justify-center">
        <button class="btn_close absolute top-5 right-5 text-5xl text-white">
            <i class="fas fa-times"></i>
        </button> 
        <div class="div_add__div w-4/6 min-h-[400px] bg-white rounded-lg">
            <x-common.form_add_patient /> 
        </div> 
    </div> 
    <x-common.dashboard_nav/>
    
    <div class="w-3/4 h-screen overflow-y-scroll b">
        <x-common.header_dashboard/>

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
                        <input type="text" id="name" wire:model="name" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" wire:model="email" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-bold mb-2">Dirección</label>
                        <input type="text" id="address" wire:model="address" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-bold mb-2">Teléfono</label>
                        <input type="text" id="phone" wire:model="phone" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="dni" class="block text-gray-700 font-bold mb-2">DNI</label>
                        <input type="text" id="dni" wire:model="dni" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="obra_social" class="block text-gray-700 font-bold mb-2">Obra Social</label>
                        <input type="text" id="obra_social" wire:model="obra_social" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 duration-300">
                            Actualizar Paciente
                        </button>
                    </div>
                </form>
            </div>

       




       






       
    </div>

    
   
</div>



