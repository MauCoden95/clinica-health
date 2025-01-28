<div>
    <div class="text-center mt-12 text-2xl">Registrar nuevo paciente</div>
    
  
    <form wire:submit.prevent="register" class="w-full p-12 grid gap-3 grid-cols-2" autoComplete="off">
        <div>
            <input wire:model="name" class="w-full p-3 border-b border-red-500" type="text" name="name" placeholder="Nombre completo..."/>    
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <input wire:model="email" class="w-full p-3 border-b border-red-500" type="email" name="email" placeholder="Correo electrónico..."/>    
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="phone" class="w-full p-3 border-b border-red-500" type="number" name="phone" placeholder="Teléfono..."/>    
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="address" class="w-full p-3 border-b border-red-500" type="text" name="address" placeholder="Dirección..."/>    
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="dni" class="w-full p-3 border-b border-red-500" type="number" name="dni" placeholder="Dni..."/>    
            @error('dni') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="obra_social" class="w-full p-3 border-b border-red-500" type="text" name="obra_social" placeholder="Obra Social..."/> 
            @error('obra_social') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button class="w-full p-3 mt-4 text-xl bg-red-500 hover:bg-red-400 duration-300 col-span-2"> 
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>