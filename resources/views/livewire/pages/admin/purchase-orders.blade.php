<div x-data="{ sidebarOpen: false, showPurchaseOrders: false }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">



            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">



                @if(count($groupedBySupplier) >= 1)
                <div class="grid gap-7 grid-cols-2">
                    <button @click="showPurchaseOrders = true" class="w-auto h-12 px-8 mb-6 rounded-md p-2 duration-300 bg-green-400 hover:bg-green-500">
                        Generar orden de compra
                        <i class="fas fa-file-invoice-dollar"></i>



                    </button>
                </div>
                @endif



            </div>




            <x-common.products-replanished :productsToReplenished="$productsToReplenished" />






            {{-- Modal para ver los reportes --}}
            <div x-show="showPurchaseOrders" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="w-3/5 bg-white p-6 rounded-lg shadow-lg max-h-[80vh] overflow-y-auto">
                    <h2 class="text-2xl text-center">Generar ordenes de compra</h2>






                    <div class="mt-5">
                        @forelse($groupedBySupplier as $supplier)
                        <div class="mb-8">

                            <form wire:submit.prevent="generatePurchaseOrder({{ $supplier->id }})">
                                <div class="w-full flex items-center justify-between">
                                    <h2 class="text-lg font-bold text-gray-700 mb-3">Proveedor: {{ $supplier->name }}</h2>
                                    <button class="w-auto h-12 px-3 mb-6 rounded-md duration-300 bg-green-400 hover:bg-green-500">
                                        Generar orden
                                        <i class="fas fa-file-invoice-dollar"></i>
                                    </button>
                                </div>
                                <table border="1" cellpadding="10" class="w-full mb-12">
                                    <thead>
                                        <tr>
                                            <th class="bg-red-500 text-sm text-white text-center">Producto</th>
                                            <th class="bg-red-500 text-sm text-white text-center">Precio/Unidad</th>
                                            <th class="bg-red-500 text-sm text-white text-center">Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($supplier->products as $product)
                                        <tr>


                                            <td class="text-center text-sm w-1/3">
                                                <input
                                                    type="text"
                                                    wire:model="product_name.{{ $product->id }}"
                                                    class="w-full block m-auto rounded-md border-2 border-gray-300 text-center text-sm"
                                                    readonly>
                                            </td>
                                            <td class="text-center text-sm w-1/3">
                                                <input
                                                    type="number"
                                                    wire:model="product_price.{{ $product->id }}"
                                                    class="w-full block m-auto rounded-md border-2 border-gray-300 text-center text-sm"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input
                                                    class="w-24 block m-auto placeholder:text-gray-500 rounded-md border-2 border-red-400"
                                                    type="number"
                                                    wire:model="product_stock_reposition.{{ $product->id }}"
                                                    min="{{ $product->stock_reposition }}">
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </form>
                        </div>
                        @empty
                        <p>No hay productos con stock bajo.</p>
                        @endforelse
                    </div>


                    <button @click="showPurchaseOrders = false" class="block m-auto mt-5 px-5 bg-gray-600 hover:bg-gray-700 text-white p-2">
                        Cerrar
                        <i class="fas fa-times"></i>
                    </button>

                </div>
            </div>





        </main>





    </div>
</div>