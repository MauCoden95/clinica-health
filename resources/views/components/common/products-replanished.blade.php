<div>
    <h2 class="text-center text-2xl my-12">Productos que hay que reponer</h2>

    <table class="w-11/12 m-auto mt-6 mb-12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        @if (count($productsToReplenished) > 0)
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
            @foreach ($productsToReplenished as $product)
            <tr class="bg-gray-200 border-b ">
                <td class="px-3 py-2 text-center text-gray-900">{{ $product->name }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $product->description }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $product->price }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $product->stock }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $product->stock_reposition }}</td>
                <td class="px-3 py-2 text-center text-gray-900">
                    <button @click="
                        showEditProduct = true;
                        productId = {{ $product->id }};
                        productToEditId = {{ $product->id }};
                        supplier_id = {{ $product->supplier_id }};
                        name = '{{ $product->name }}'
                        description = '{{ $product->description }}'
                        price = {{ $product->price }}
                        stock = '{{ $product->stock }}'
                        stock_reposition = '{{ $product->stock_reposition }}'
                        $nextTick(() => { 
                            $wire.productId = productId;
                            $wire.name = name;
                            $wire.supplierId = supplier_id;
                            $wire.description = description;
                            $wire.price = price;
                            $wire.stock = stock;
                            $wire.stock_reposition = stock_reposition;
                        });
                    ">
                        <i class=" fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                    </button>
                    <button @click="
                            showConfirmDelete = true;
                            productToDeleteId = {{ $product->id }};
                            $nextTick(() => { 
                                $wire.productId = productToDeleteId;
                            });
                            
                        ">
                        <i
                            class="fas fa-trash-alt text-xl ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @else
            <p class="text-gray-600 text-2xl">No hay productos para reponer.</p>
            @endif
        </tbody>
    </table>
</div>