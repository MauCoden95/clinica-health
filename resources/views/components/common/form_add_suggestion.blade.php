<div>
    <div class="text-center mt-12 text-2xl">Registrar nueva queja o sugerencia</div>
    
  
    <form wire:submit.prevent="create" class="w-full p-12" autoComplete="off">
        <div>
            <input wire:model="affair" class="w-full p-3 border-b border-red-500" type="text" name="affair" placeholder="Asunto..."/>    
            @error('affair') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <textarea wire:model="description" class="w-full p-3 border-b border-red-500 mt-6" id="feedback" name="feedback" rows="8" cols="50" placeholder="Descripción..."></textarea><br><br>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        

        <button class="w-full p-3 text-xl bg-red-500 hover:bg-red-400 duration-300"> 
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>