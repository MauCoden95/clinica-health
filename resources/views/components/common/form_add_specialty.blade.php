<div>
    <div class="text-center mt-12 text-2xl">Registrar nueva especialidad</div>
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('alertSuccess', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: data[0].type,
                    confirmButtonText: 'Aceptar'
                });
            });
        });
    </script>
  
    <form wire:submit.prevent="create" class="w-full p-12 grid gap-3 grid-cols-2" autoComplete="off">
        <div>
            <input wire:model="specialty" class="w-full p-3 border-b border-red-500" type="text" name="specialty" placeholder="Especialidad..."/>    
            @error('specialty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        
        

        <button class="w-full p-3 text-xl bg-red-500 hover:bg-red-400 duration-300"> 
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>