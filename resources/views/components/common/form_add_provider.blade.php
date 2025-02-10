<div>
    <div class="text-center mt-14 text-2xl">Registrar nuevo proveedor</div>
    
  
    <form wire:submit.prevent="create" class="w-full p-5 grid gap-3 grid-cols-2" autoComplete="off">
        <div>
            <input wire:model="name" class="w-full p-3 border-b border-red-500" type="text" name="name" placeholder="Nombre..."/>    
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <input wire:model="address" class="w-full p-3 border-b border-red-500" type="text" name="address" placeholder="Direccion..."/>    
            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="phone" class="w-full p-3 border-b border-red-500" type="text" name="phone" placeholder="Telefono..."/>    
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <input wire:model="email" class="w-full p-3 border-b border-red-500" type="text" name="email" placeholder="Email..."/>    
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <input wire:model="cuil" class="w-full p-3 border-b border-red-500" type="text" name="cuil" placeholder="Cuil..."/>    
            @error('cuil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        

        <button class="w-full p-2 text-xl bg-red-500 hover:bg-red-400 duration-300"> 
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>