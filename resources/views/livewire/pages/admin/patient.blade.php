<div class="flex">
   
    <x-common.dashboard_nav/>
    
    <div class="w-3/4 h-screen">
        <x-common.header_dashboard/>

        

        <div class="w-full px-14 overflow-x-auto">
            <div class="relative w-60 h-40 mt-20 bg-red-500 rounded-lg overflow-hidden">
                <h3 class="text-center my-3 text-xl">Cantidad de pacientes</h3>
                <i class="absolute -left-7 -bottom-7 text-9xl text-red-900 w-1/6 fas fa-user"></i>
                <h3 class="absolute right-4 bottom-4 text-5xl px-3 py-2 text-center text-gray-900">
                    {{ $count_patients }}
                </h3>
            </div>   
        </div>
       
        <div class="relative w-full px-14 overflow-x-auto">
            <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Todos los pacientes</h3>
            
            <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-red-600 ">
                    <tr>
                        <th scope="col" class="px-3 py-1 text-center">
                            Nombre
                        </th>
                        <th scope="col" class="px-3 py-1 text-center">
                            Email
                        </th>
                        <th scope="col" class="px-3 py-1 text-center">
                            Telefono
                        </th>
                        <th scope="col" class="px-3 py-1 text-center">
                            Dirección
                        </th>
                        <th scope="col" class="px-3 py-1 text-center">
                            Dni
                        </th>
                        <th scope="col" class="px-3 py-1 text-center">
                            Obra Social
                        </th>
                        <th scope="col" class="px-3 py-1 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if(count($patients) > 0)                   
                        @foreach($patients as $patient)
                            <tr class="bg-gray-200 border-b ">
                                <td class="px-3 py-2 text-center text-gray-900">
                                    {{ $patient->name }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-900">
                                    {{ $patient->email }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-900">
                                    {{ $patient->phone }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-900">
                                    {{ $patient->address }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-900">
                                    {{ $patient->dni }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-900">
                                    {{ $patient->obra_social }}
                                </td>
                                <td class="px-3 py-2 text-center text-gray-900">
                                    <a href="#" class="text-2xl"><i class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                    <a href="#" class="text-2xl"><i class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i></a>
                                </td>
                            </tr>
                        @endforeach
                  
                @else
                    <p class="text-gray-600">No hay pacientes registrados.</p>
                @endif   
                   
                </tbody>
            </table>
        </div>


       
    </div>

    
   
</div>
