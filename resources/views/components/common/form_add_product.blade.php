<div>
    <h2 class="text-xl text-center font-semibold mb-4">Nuevo producto</h2>
    
  
    <form wire:submit.prevent="create" class="w-full p-2" autoComplete="off">
        <div class="mb-2">
            <input wire:model="name" class="w-full p-3 border-b border-red-500" type="text" name="name" placeholder="Producto..."/>    
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <select wire:model="supplierId" class="w-full p-3 border-b border-red-500" name="supplierId">
                <option value="">Seleccione un proveedor...</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
            @error('supplierId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        

        <div class="mb-2">
            <input wire:model="description" class="w-full p-3 border-b border-red-500" type="text" name="description" placeholder="Descripcion..."/>    
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <input wire:model="price" class="w-full p-3 border-b border-red-500" type="number" name="price" placeholder="Precio..."/>    
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <input wire:model="stock" class="w-full p-3 border-b border-red-500" type="number" name="stock" placeholder="Stock..."/>    
            @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <input wire:model="stock_reposition" class="w-full p-3 border-b border-red-500" type="number" name="stock_reposition" placeholder="Stock de reposición..."/>    
            @error('stock_reposition') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        

        <button class="w-full p-3 mt-4 text-xl bg-red-500 hover:bg-red-400 duration-300 col-span-2"> 
            Guardar <i class="fas fa-save"></i>
        </button>
    </form>
</div>