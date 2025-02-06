<div>
    <table class="w-full m-auto mt-6 mb-12 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-white uppercase bg-red-600 ">
            <tr>
                <th scope="col" class="px-3 py-1 text-center">ID</th>
                <th scope="col" class="px-3 py-1 text-center">Nombre</th>
                <th scope="col" class="px-3 py-1 text-center">Email</th>
                <th scope="col" class="px-3 py-1 text-center">Dirección</th>
                <th scope="col" class="px-3 py-1 text-center">Telefono</th>
                <th scope="col" class="px-3 py-1 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($suppliers as $supplier)
            <tr class="bg-gray-200 border-b ">
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->id }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->name }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->email }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->address }}</td>
                <td class="px-3 py-2 text-center text-gray-900">{{ $supplier->phone }}</td>
                <td class="px-3 py-2 text-center text-gray-900">
                    <button>
                        <i class=" fas fa-edit text-xl text-blue-600 hover:text-blue-400 duration-300"></i>
                    </button>
                    <button>
                        <i class="fas fa-trash-alt text-xl ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
