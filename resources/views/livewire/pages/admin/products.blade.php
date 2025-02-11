<div x-data="{ sidebarOpen: false, showCreateProduct: false, showProviders: false, showFormCreate: false, showConfirmDelete: false, productToDeleteId: null }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <x-common.count :item="'Cantidad de productos'" :quantity="$count_products" :icon="'fas fa-syringe'" />


                <div class="flex flex-col">
                    <button @click="showProviders = true" class="w-auto h-12 mb-6 rounded-md p-2 duration-300 bg-green-400 hover:bg-green-500">
                        Ver proveedores
                        <i class="fas fa-warehouse"></i>
                    </button>

                    <button @click="showCreateProduct = true" class="w-auto h-12 mb-6 rounded-md p-2 duration-300 bg-green-400 hover:bg-green-500">
                        Nuevo
                        <i class="fas fa-plus-circle"></i>
                    </button>

                </div>


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
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->name }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->description }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->price }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->stock }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">{{ $product->stock_reposition }}</td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                <button ">
                                    <i class=" fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                                </button>
                                <button @click="
                                        showConfirmDelete = true;
                                        productToDeleteId = {{ $product->id }};
                                        $nextTick(() => { 
                                            $wire.productId = productToDeleteId
                                        });
                                        
                                    ">
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
                <div class="relative w-5/6 bg-white p-6 rounded-lg text-center max-h-[80vh] overflow-y-auto">
                    <h2 class="text-2xl font-semibold mb-4">Listado de proveedores</h2>

                    <div class="flex justify-start mb-4">
                        <button @click="showFormCreate = true"
                            class="h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                            Registrar nuevo proveedor <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>

                    <x-common.supplier_list />

                    <button class="px-3 py-2 rounded-sm text-white bg-red-500" @click="showProviders = false">
                        Cerrar <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>





            {{-- Modal para crear proveedor --}}
            <div x-show="showFormCreate" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div @click.outside="showFormCreate = false" class="w-3/6 bg-white p-6 rounded-lg text-center">
                    <livewire:create-supplier-form />
                    <button class="px-3 py-2 rounded-sm text-white bg-gray-600" @click="showFormCreate = false">
                        Cerrar
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>





            {{-- Modal para confirmar eliminacion del producto --}}
            <div x-show="showConfirmDelete" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                    <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
                    <p class="text-gray-700 mb-6">El producto será eliminado de forma permanente.</p>
                    <div class="flex justify-end">
                        <button @click="showConfirmDelete = false" class="px-4 py-2 mr-2 bg-gray-300 hover:bg-gray-400 rounded">Cancelar</button>
                        <button @click="showConfirmDelete = false" wire:click="deleteProduct" class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded">Eliminar</button>
                    </div>
                </div>
            </div>




            {{-- Modal para crear producto --}}
            <div x-show="showCreateProduct" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 max-h-[80vh] overflow-y-auto">
                    <x-common.form_add_product :suppliers="$suppliers" />
                    <div class="flex justify-center">
                        <button @click="showCreateProduct = false" class="px-4 py-2 mr-2 text-white bg-gray-600 hover:bg-gray-400 rounded">Cerrar</button>
                    </div>
                </div>
            </div>


        </main>





    </div>
</div>