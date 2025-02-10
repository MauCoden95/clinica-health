<div x-data="{ confirmDeleteVisible: false, editSupplierVisible: false, supplierIdToDelete: null, supplierId: null, name: null, address: null, email: null, phone: 0, cuil: 0 }">
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
                    <button
                        @click="
                            editSupplierVisible = true; 
                            supplierId = {{ $supplier->id }};
                            name = '{{ $supplier->name }}';
                            address = '{{ $supplier->address }}';
                            email = '{{ $supplier->email }}';
                            phone = '{{ $supplier->phone }}';
                            cuil = '{{ $supplier->cuil }}';
                            $nextTick(() => { 
                                        $wire.supplierId = {{ $supplier->id }};
                                        $wire.name = name;
                                        $wire.address = address;
                                        $wire.email = email;
                                        $wire.phone = phone;
                                        $wire.cuil = cuil;
                                    });
                            ">
                        <i class=" fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                    </button>
                    <button
                        @click="
                            confirmDeleteVisible = true;
                            supplierIdToDelete = {{ $supplier->id }};
                            $nextTick(() => { 
                                $wire.supplierId = supplierIdToDelete;
                            });
                        ">
                        <i class="fas fa-trash-alt text-xl ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                    </button>


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
                wire:click="deleteSupplier()"
                @click="confirmDeleteVisible = false"
                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, eliminar</button>
            <button @click="confirmDeleteVisible = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>


    {{-- Modal para editar proveedor --}}
    <div x-show="editSupplierVisible" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="w-4/6 bg-white p-6 rounded-lg text-center">
            <h2 class="mb-4 text-2xl font-bold">Editar proveedor</h2>
            <form wire:submit.prevent="editSupplier()" class="w-full p-5 mb-5 grid gap-3 grid-cols-2" autoComplete="off">

                <input
                    wire:model.defer="name"
                    x-bind:value="name"
                    class="w-full p-3 border-b border-red-500"
                    type="text"
                    name="name"
                    placeholder="Nombre..." />

                <input
                    wire:model.defer="address"
                    x-bind:value="address"
                    class="w-full p-3 border-b border-red-500"
                    type="text"
                    name="address"
                    placeholder="Dirección..." />

                <input
                    wire:model.defer="phone"
                    x-bind:value="phone"
                    class="w-full p-3 border-b border-red-500"
                    type="text"
                    name="phone"
                    placeholder="Teléfono..." />

                <input
                    wire:model.defer="email"
                    x-bind:value="email"
                    class="w-full p-3 border-b border-red-500"
                    type="text"
                    name="email"
                    placeholder="Email..." />

                <input
                    wire:model.defer="cuil"
                    x-bind:value="cuil"
                    class="w-full p-3 border-b border-red-500"
                    type="text"
                    name="cuil"
                    placeholder="CUIL..." />


                <button class="w-full p-2 text-xl bg-red-500 hover:bg-red-400 duration-300">
                    Editar <i class="fas fa-edit"></i>
                </button>
            </form>
            <button @click="editSupplierVisible = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>
</div>