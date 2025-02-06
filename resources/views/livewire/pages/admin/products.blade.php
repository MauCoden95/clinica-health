<div x-data="{ sidebarOpen: false, showProviders: false }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <x-common.count :item="'Cantidad de productos'" :quantity="$count_products" :icon="'fas fa-syringe'" />


                <button @click="showProviders = true" class="w-auto h-12 rounded-md p-2 text-white duration-300 bg-green-500 hover:bg-green-800">
                    <i class="fas fa-warehouse mr-3"></i>
                    Ver proveedores
                </button>
            </div>

            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todos los productos</h3>


                <span class="">
                    Ver productos a reponer
                    <input class="ml-2" type="checkbox" wire:model="showProductsReposition" wire:click="showProductsToReposition">
                </span>
                <table class="w-full m-auto mt-6 mb-12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    @if (count($products) > 0)
                    <thead class="text-xs text-white uppercase bg-red-600 ">
                        <tr>
                            <th scope="col" class="px-3 py-1 text-center">ID</th>
                            <th scope="col" class="px-3 py-1 text-center">Producto</th>
                            <th scope="col" class="px-3 py-1 text-center">Descripcion</th>
                            <th scope="col" class="px-3 py-1 text-center">Precio</th>
                            <th scope="col" class="px-3 py-1 text-center">Stock</th>
                            <th scope="col" class="px-3 py-1 text-center">Stock de reposición</th>
                            <th scope="col" class="px-3 py-1 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($products as $product)
                        <tr class="bg-gray-200 border-b ">
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->id }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->name }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->description }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->price }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->stock }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->stock_reposition }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                <button ">
                                    <i class=" fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                                </button>
                                <button>
                                    <i
                                        class="fas fa-trash-alt text-xl ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p class="text-gray-600 text-2xl">No hay especialidades registradas.</p>
                        @endif
                    </tbody>
                </table>
            </div>



            {{-- Modal para ver los proveedores --}}
            <div x-show="showProviders" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="w-5/6 bg-white p-6 rounded-lg text-center">
                    <h2 class="text-xl font-semibold mb-4">Listado de proveedores</h2>
                    <x-common.supplier_list />
                    <button class="px-3 py-2 rounded-sm text-white bg-red-500" @click="showProviders = false">
                        Cerrar
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </main>





    </div>
</div>