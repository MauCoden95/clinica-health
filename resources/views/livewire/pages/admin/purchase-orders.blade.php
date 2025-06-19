<div x-data="{ sidebarOpen: false, showPurchaseOrders: false }" class="flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">




                <div class="grid gap-7 grid-cols-2">
                    <button @click="showPurchaseOrders = true" class="w-auto h-12 px-8 mb-6 rounded-md p-2 duration-300 bg-green-400 hover:bg-green-500">
                        Generar orden de compra
                        <i class="fas fa-file-invoice-dollar"></i>



                    </button>
                </div>



            </div>




            <x-common.products-replanished :productsToReplenished="$productsToReplenished" />






            {{-- Modal para ver los reportes --}}
            <div x-show="showPurchaseOrders" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="w-3/5 bg-white p-6 rounded-lg shadow-lg max-h-[80vh] overflow-y-auto">
                    <h2 class="text-2xl text-center">Generar orden de compra</h2>






                    <div>
                        <table border="1" cellpadding="10" class="mt-5">
                            <thead>
                                <tr>
                                    <th class="bg-red-500 text-white">Proveedor</th>
                                    <th class="bg-red-500 text-white">Producto</th>
                                    <th class="bg-red-500 text-white">Stock de Reposición</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($groupedBySupplier as $supplier)
                                @php
                                $products = $supplier->products;
                                $rowspan = $products->count();
                                @endphp

                                @if($rowspan > 0)
                                @foreach($products as $index => $product)
                                <tr>
                                    @if($index === 0)
                                    <td rowspan="{{ $rowspan }}" class="mt-12">{{ $supplier->name }}</td>
                                    @endif
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->stock_reposition }}</td>
                                </tr>
                                @endforeach
                                @endif
                                @empty
                                <tr>
                                    <td colspan="4">No hay productos con stock bajo.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>





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