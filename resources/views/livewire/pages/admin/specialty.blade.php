<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 overflow-hidden">

    <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
        class="bg-white w-64 min-h-screen flex flex-col md:block">
        <div class="flex items-center justify-center h-24 border-b">
            <img class="w-28" src="http://localhost:8000/img/Logo.png" />
        </div>
        <x-common.dashboard_nav />
    </div>


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />


        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white ">

            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <div class="relative w-60 h-40 bg-red-500 rounded-lg overflow-hidden">
                    <h3 class="text-center my-3 text-xl">Cantidad de especialidades</h3>
                    <i class="absolute -left-7 -bottom-7 text-9xl text-red-900 w-1/6 fas fa-user-md"></i>
                    <h3 class="absolute right-4 bottom-4 text-5xl px-3 py-2 text-center text-gray-900">
                        {{ $count_specialties }}
                    </h3>
                </div>


                <div x-data="{ visible: false }">
                    <button @click="visible = true"
                        class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                        Nuevo <i class="fas fa-plus-circle"></i>
                    </button>


                    <div x-show="visible" x-bind:style="{ display: visible ? 'flex' : 'none' }"
                        class="z-50 div_add fixed inset-0 flex items-center justify-center">
                        <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                            <i class="fas fa-times"></i>
                        </button>
                        <div :class="{ 'animated-div': visible }"
                            class="div_add__div w-4/6 min-h-[100px] bg-white rounded-lg">
                            <x-common.form_add_specialty />
                        </div>
                    </div>
                </div>












            </div>








            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todas las especialidades</h3>








                <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">


                    @if (count($specialties) > 0)
                        <thead class="text-xs text-white uppercase bg-red-600 ">
                            <tr>
                                <th scope="col" class="px-3 py-1 text-xl text-center">
                                    ID
                                </th>
                                <th scope="col" class="w-3/5 px-3 py-1 text-xl text-center">
                                    Especialidad
                                </th>
                                <th scope="col" class="px-3 py-1 text-xl text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($specialties as $specialty)
                                <tr class="bg-gray-200 border-b ">
                                    <td class="px-3 py-2 text-center text-xl text-gray-900">
                                        {{ $specialty->id }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-xl text-gray-900">
                                        {{ $specialty->specialty }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-xl text-gray-900">
                                        <a wire:navigate href="{{ route('edit.specialty', ['id' => $specialty->id]) }}"
                                            class="text-xl"><i
                                                class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                        <button onclick="confirmDelete({{ $specialty->id }})" class="text-xl">
                                            <i
                                                class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-2xl">No hay doctores registrados.</p>
                    @endif


                    </tbody>
                </table>
            </div>





        </main>
    </div>
</div>







<script>
    function confirmDelete(specialtyId) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "La especialidad será eliminada",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                console.log("Emitir evento Livewire");
                Livewire.dispatch('deleteConfirmed', {
                    specialtyId
                });



                Swal.fire({
                    title: "Eliminado!",
                    text: "La especialidad fue eliminada.",
                    icon: "success"
                });
            }
        });
    }
</script>
