<div>
    <div class="text-center mt-14 text-2xl">Registrar nueva categoría</div>
    
  
    <form wire:submit.prevent="create" class="w-full p-5 flex flex-col" autoComplete="off">
        <div>
            <input wire:model="name" class="w-full p-3 my-5 border-b border-red-500" type="text" name="name" placeholder="Nombre..."/>    
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        
        <button class="w-full p-2 mb-5 text-xl bg-red-500 hover:bg-red-400 duration-300"> 
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>