<div x-data="{ sidebarOpen: false, confirmSupplierCreateVisible: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">
    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">

                <x-common.count :item="'Cantidad de proveedores'" :quantity="$count_suppliers" :icon="'fas fa-truck'" />

                <div>
                    <button @click="confirmSupplierCreateVisible = true" class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Nuevo <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
            </div>

            <div class="px-14 mt-6">
                <div class="mt-12 mb-6">
                    <input wire:model.live="nameFilter" type="text" placeholder="Buscar por nombre..."
                        class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <div class="bg-white rounded-lg shadow">
                    <div class="overflow-x-auto">
                        <table class="w-full mb-24">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-center bg-red-500 text-white uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center bg-red-500 text-white uppercase tracking-wider">Dirección</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center bg-red-500 text-white uppercase tracking-wider">Teléfono</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center bg-red-500 text-white uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center bg-red-500 text-white uppercase tracking-wider">CUIL</th>
                                    <th class="px-6 py-3 text-xs font-medium text-center bg-red-500 text-white uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td class="text-center px-6 py-4 whitespace-nowrap text-sm bg-gray-100 text-gray-900">{{ $supplier->name }}</td>
                                    <td class="text-center px-6 py-4 whitespace-nowrap text-sm bg-gray-100 text-gray-900">{{ $supplier->address }}</td>
                                    <td class="text-center px-6 py-4 whitespace-nowrap text-sm bg-gray-100 text-gray-900">{{ $supplier->phone }}</td>
                                    <td class="text-center px-6 py-4 whitespace-nowrap text-sm bg-gray-100 text-gray-900">{{ $supplier->email }}</td>
                                    <td class="text-center px-6 py-4 whitespace-nowrap text-sm bg-gray-100 text-gray-900">{{ $supplier->cuil }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium bg-gray-100 flex items-center justify-center">
                                        <button class="text-base">
                                            <i class="fas fa-edit ml-4 text-blue-600 hover:text-blue-400 duration-300"></i>
                                        </button>
                                        <button class="text-base">
                                            <i class="fas fa-trash-alt ml-2 text-red-600 hover:text-red-400 duration-300"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="px-14 my-6">
                <form class="mt-24 flex flex-col" action="{{ route('import-suppliers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (session()->has('success'))
                    <div class="bg-green-400 text-green-800 p-4 rounded-md mb-6">
                        {{ session('success') }}
                    </div>
                    @elseif (session()->has('error'))
                    <div class="bg-red-400 text-red-800 p-4 rounded-md mb-6">
                        <p>¡Error al importar proveedores!</p>
                    </div>
                    @endif
                    <h2 class="text-2xl font-bold mb-6">Importar y exportar proveedores</h2>
                    <input type="file" name="excel_file" required>
                    <div class="w-2/5 flex items-center justify-between">
                        <button class="w-2/4 mt-6 mr-2 bg-red-500 hover:bg-red-600 duration-300 text-white px-5 py-2" type="submit">Importar</button>
                        <a href="{{ route('export-suppliers') }}" class="block w-2/4 mt-6 bg-yellow-500 hover:bg-yellow-600 duration-300 text-white px-5 py-2 text-center">Exportar</a>
                    </div>
                </form>
            </div>

            {{-- Modal para crear proveedores --}}
            <div x-show="confirmSupplierCreateVisible" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <button @click="confirmSupplierCreateVisible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                    <i class="fas fa-times"></i>
                </button>
                <div class="w-4/6 bg-white p-6 rounded-lg text-center">
                    <form wire:submit.prevent="createSupplier">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" class="w-full p-2 mb-5 border border-red-500 rounded-md" placeholder="Nombre" wire:model="name">
                            <input type="text" class="w-full p-2 mb-5 border border-red-500 rounded-md" placeholder="Dirección" wire:model="address">
                            <input type="text" class="w-full p-2 mb-5 border border-red-500 rounded-md" placeholder="Teléfono" wire:model="phone">
                            <input type="email" class="w-full p-2 mb-5 border border-red-500 rounded-md" placeholder="Email" wire:model="email">
                            <input type="text" class="w-full p-2 mb-5 border border-red-500 rounded-md" placeholder="CUIL" wire:model="cuil">
                            
                            <button type="submit" class="w-full h-11 text-xl bg-red-500 hover:bg-red-600 duration-300 text-white p-2 rounded-md col-span-2">
                                Guardar
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
