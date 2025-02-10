<div x-data="{ confirmDeleteVisible: false, supplierId: null }">
    <h2>Total proveedores: <strong>{{ $count_suppliers }}</strong></h2>
    <table class="w-full m-auto mt-6 mb-12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-red-600 ">
            <tr>
                <th scope="col" class="px-3 py-1 text-center">Nombre</th>
                <th scope="col" class="px-3 py-1 text-center">Email</th>
                <th scope="col" class="px-3 py-1 text-center">Dirección</th>
                <th scope="col" class="px-3 py-1 text-center">Telefono</th>
                <th scope="col" class="px-3 py-1 text-center">CUIL</th>
                <th scope="col" class="px-3 py-1 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($suppliers as $supplier)
            <tr class="bg-gray-200 border-b ">
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->name }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->email }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->address }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->phone }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->cuil }}</td>
                <td class="px-3 py-2 text-center text-gray-900">
                    <button>
                        <i class=" fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                    </button>
                    <button @click="confirmDeleteVisible = true; supplierId = {{ $supplier->id }}">
                        <i class="fas fa-trash-alt text-xl ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                    </button>
                   {{-- <button wire:click="deleteSupplier({{ $supplier->id }})">
                        <i class="fas fa-trash-alt text-xl ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                    </button>--}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{-- Modal para confirmar eliminacion de proveedor --}}
    <div x-show="confirmDeleteVisible" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
            <p class="mb-4">El proveedor será eliminado</p>
            <button
                @click="confirmDeleteVisible = false"
                wire:click="deleteSupplier({{ $supplier->id }})"
                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, eliminar</button>
            <button @click="confirmDeleteVisible = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>
</div>
