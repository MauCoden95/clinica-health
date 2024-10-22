<div class="relative flex">
    
    <x-common.dashboard_nav/>
    
    <div class="w-3/4 h-screen overflow-y-scroll">
        <x-common.header_dashboard/>

        

        <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
            <div class="relative w-60 h-40 bg-red-500 rounded-lg overflow-hidden">
                <h3 class="text-center my-3 text-xl">Cantidad de doctores</h3>
                <i class="absolute -left-7 -bottom-7 text-9xl text-red-900 w-1/6 fas fa-user-md"></i>
               <h3 class="absolute right-4 bottom-4 text-5xl px-3 py-2 text-center text-gray-900">
                    {{ $count_doctors }}
                </h3>
            </div> 
            
            <div x-data="{ visible: false }">
                <button @click="visible = true" class="btn_add h-12 p-3 bg-green-400 hover:bg-green-500 duration-300 rounded-md">
                    Nuevo <i class="fas fa-plus-circle"></i>
                </button> 

                <div x-show="visible" x-bind:style="{ display: visible ? 'flex' : 'none' }" class="z-50 div_add fixed inset-0 flex items-center justify-center">
                    <button @click="visible = false" class="btn_close absolute top-5 right-5 text-5xl text-white">
                        <i class="fas fa-times"></i>
                    </button>
                    <div :class="{'animated-div': visible}" class="div_add__div w-4/6 min-h-[400px] bg-white rounded-lg">
                        <x-common.form_add_doctor :specialties="$specialties" />
                    </div>
                </div>
            </div>


            


            
        </div>




        <div class="relative w-full px-14 overflow-x-auto mb-7">
            <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todos los médicos</h3>
            
            <div class="mt-4 mb-6">
                <input wire:model.live="dniFilter" type="text" placeholder="Buscar por DNI" class="w-full p-2 border border-gray-300 rounded-md">
            </div>
        
            
            <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        
                        @if(count($doctors) > 0)         
                        <thead class="text-xs text-white uppercase bg-red-600 ">
                            <tr>
                                <th scope="col" class="px-3 py-1 text-center">
                                    ID
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Nombre
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Especialidad
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Teléfono
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Dirección
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Licencia
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Dni
                                </th>
                                <th scope="col" class="px-3 py-1 text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                       
                        <tbody>          
                                @foreach($doctors as $doctor)
                                    <tr class="bg-gray-200 border-b ">
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->id }} 
                                        </td>
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->user->name }} 
                                        </td>
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->specialty->specialty }}
                                        </td>
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->user->phone }} 
                                        </td>
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->user->address }} 
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->license }} 
                                        </td>
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            {{ $doctor->user->dni }} 
                                        </td>
                                        <td class="px-3 py-2 text-center text-gray-900">
                                            <a wire:navigate href="{{ route('edit.doctor', ['id' => $doctor->id]) }}" class="text-xl"><i class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                            <button onclick="confirmDelete({{ $doctor->id }})" class="text-xl">
                                                <i class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i>
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






       
    </div>

    
   
</div>






<script>
    function confirmDelete(doctorId) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "El doctor será eliminado",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                console.log("Emitir evento Livewire");
                Livewire.dispatch('deleteConfirmed', {doctorId});

                

                Swal.fire({
                    title: "Eliminado!",
                    text: "El doctor fue eliminado.",
                    icon: "success"
                });
            } 
        });
    }
</script>