<div x-data="{ editPaymentMethodShow: false, confirmDelete: false, id: 0, name: '', description: '' }">
    <table class="w-full m-auto my-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        @if (count($paymentMethods) > 0)
        <thead class="text-xs text-white uppercase bg-red-600">
            <tr>
                <th scope="col" class="px-3 py-1 text-center">Nombre</th>
                <th scope="col" class="px-3 py-1 text-center">Descripción</th>
                <th scope="col" class="px-3 py-1 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($paymentMethods as $paymentMethod)
            <tr class="bg-gray-200 border-b">
                <td class="px-3 py-2 text-center text-gray-900">{{ $paymentMethod->name }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $paymentMethod->description }}</td>
                <td class="px-3 py-2 text-center text-gray-900">
                    <button @click="
                        editPaymentMethodShow = true;
                        id = {{ $paymentMethod->id }};
                        name = '{{ $paymentMethod->name }}';
                        description = '{{ $paymentMethod->description }}';
                        $dispatch('edit-payment-method', {
                            id: {{ $paymentMethod->id }},
                            name: '{{ $paymentMethod->name }}',
                            description: '{{ $paymentMethod->description }}'
                        });
                    ">
                        <i class="fas fa-edit text-blue-500 hover:text-blue-800 text-xl"></i>
                    </button>


                    <button @click="confirmDelete = true; 
                            name = '{{ $paymentMethod->name }}' 
                            id = {{ $paymentMethod->id }}">
                        <i class="fas fa-trash ml-3 text-red-500 text-xl"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <tr>
            <td colspan="8" class="text-gray-600 text-2xl text-center">No hay métodos de pago registrados.</td>
        </tr>
        @endif
    </table>


    <div x-show="editPaymentMethodShow" @payment-method-added.window="editPaymentMethodShow = false" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">Editar método de pago</h2>
            <form wire:submit.prevent="editPaymentMethod(id)">
                <input type="text" placeholder="Nombre" wire:model="name" x-model="name" class="w-full p-3 border border-red-500 rounded-md mb-4">
                <input type="text" placeholder="Descripción" wire:model="description" x-model="description" class="w-full p-3 border border-red-500 rounded-md mb-4">
                <div>
                    <button type="submit" class="h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">Agregar</button>
                    <button type="button" @click="editPaymentMethodShow = false" class="h-12 p-3 mt-6 bg-gray-300 hover:bg-gray-400 duration-300 rounded-md">Cancelar</button>
                </div>
            </form>

        </div>
    </div>



    <div x-show="confirmDelete" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">¿Estás seguro de eliminar este método de pago?</h2>
            <h3 x-text="name"></h3>
            <button wire:click="deletePaymentMethod(id)" @click="confirmDelete = false" type="button" class="h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">Confirmar</button>
            <button type="button" @click="confirmDelete = false" class="h-12 p-3 mt-6 bg-gray-300 hover:bg-gray-400 duration-300 rounded-md">Cancelar</button>


        </div>
    </div>
</div>