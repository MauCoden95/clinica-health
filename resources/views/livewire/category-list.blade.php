<div x-data="{categoryId: null, deleteConfirm: false, addCategory: false}">
    <h2 class="text-2xl text-center my-4">Listado de categorías</h2>
    <h2 class="text-center my-3">Cantidad de categorías: {{ $count_categories }}</h2>
    <div class="flex justify-start mb-4">
        <button @click="addCategory = true"
            class="m-auto h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
            Registrar nueva categoría <i class="fas fa-plus-circle"></i>
        </button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="bg-red-500 border-gray-500 text-white text-center">Nombre</th>
                <th class="bg-red-500 border-gray-500 text-white text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td class="text-center bg-gray-200 border-gray-500">{{ $category->name }}</td>
                <td class="text-center bg-gray-200 border-gray-500">
                    <button>
                        <i class="fas fa-edit text-xl text-blue-500 hover:text-blue-700"></i>
                    </button>

                    <button @click="

                        categoryId = {{ $category->id }};
                        deleteConfirm = true;
                        $nextTick(() => { $wire.categoryId = categoryId });
                    ">
                        <i class="fas fa-trash ml-3 text-xl text-red-500 hover:text-red-700"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{-- Modal para confirmar eliminación de categoría --}}
    <div x-show="deleteConfirm" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="w-2/5 bg-white p-6 rounded-lg shadow-lg max-h-[80vh] overflow-y-auto">
            <h3 class="text-lg font-bold">¿Estás seguro?</h3>
            <p class="mt-2">La categoría será eliminada.</p>
            <div class="flex justify-between mt-4">
                <button @click="deleteConfirm = false"
                    class="mr-2 px-4 py-2 bg-gray-400 text-white rounded">Cancelar</button>
                <button @click="$wire.delete(); deleteConfirm = false"
                    class="px-4 py-2 bg-red-600 text-white rounded">Eliminar</button>
            </div>
        </div>
    </div>


    {{-- Modal para crear categoría --}}
    <div x-show="addCategory" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div @click.outside="addCategory = false" class="w-3/6 bg-white p-6 rounded-lg text-center">
            <x-common.form_add_category />
            <button class="px-3 py-2 rounded-sm text-white bg-gray-600" @click="addCategory = false">
                Cerrar
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>