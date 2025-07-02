<div>
    <select wire:model.live="supplierId" class="w-full p-3 my-12 border-b border-red-500" name="supplierId">
        <option value="">Seleccione un proveedor...</option>
        @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @endforeach
    </select>

    
    @if($purchaseOrders->count() > 0)
    <table class="w-full">
        <thead>
            <tr>    
                <th class="py-2 bg-red-500 text-white">#</th>
                <th class="py-2 bg-red-500 text-white">FECHA</th>
                <th class="py-2 bg-red-500 text-white">HORA</th>
                <th class="py-2 bg-red-500 text-white">TOTAL</th>
                <th class="py-2 bg-red-500 text-white">ESTADO</th>
                <th class="py-2 bg-red-500 text-white">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
            <tr>
                <td class="py-2 text-center bg-gray-300">{{ $purchaseOrder->id }}</td>
                <td class="py-2 text-center bg-gray-300">{{ date('d-m-Y', strtotime($purchaseOrder->date)) }}</td>
                <td class="py-2 text-center bg-gray-300">{{ date('H:i', strtotime($purchaseOrder->time)) }}</td>
                <td class="py-2 text-center bg-gray-300">{{ $purchaseOrder->total }} $</td>
                <td class="py-2 text-center bg-gray-300">
                    @if($purchaseOrder->state == 'Pendiente')
                        <span class="bg-blue-600 text-white px-4 py-1 rounded">{{ $purchaseOrder->state }}</span>
                    @elseif($purchaseOrder->state == 'Enviado')
                        <span class="bg-violet-600 text-white px-4 py-1 rounded">{{ $purchaseOrder->state }}</span>
                    @elseif($purchaseOrder->state == 'Entregado')
                        <span class="bg-green-500 text-white px-4 py-1 rounded">{{ $purchaseOrder->state }}</span>
                    @else
                        <span class="bg-red-600 text-white px-4 py-1 rounded">Cancelado</span>
                    @endif
                </td>
                <td class="py-2 text-center bg-gray-300">
                    <button wire:click="downloadPurchaseOrder({{ $purchaseOrder->id }}, '{{ $purchaseOrder->total }}')" class="text-white px-4 py-2 rounded">
                        <i class="fa-solid fa-download text-blue-500 hover:text-blue-700 text-xl"></i>
                    </button>

                    <select wire:model="state" class="bg-white text-gray-900 border border-gray-300 rounded">
                        <option value="">--Estado--</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Enviado">Enviado</option>
                        <option value="Entregado">Entregado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay pedidos de compra para este proveedor</p>
    @endif
</div>