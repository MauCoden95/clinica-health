<div class="flex">
    <x-common.dashboard_nav/>
    
    <div class="w-3/4 h-screen">
        <x-common.header_dashboard/>

       <div class="w-full px-14 mt-20">
            <select id="options" wire:model.change="specialtyId" name="specialtyName" class="w-3/6 p-3 border-b border-red-500">
                <option value="">--Especialidad--</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->specialty }}</option>
                @endforeach
            </select>

                @if($doctors && count($doctors) > 0)
                    <table class="w-full mt-5 m-auto border">
                        <thead>
                                <tr class="bg-red-500 text-white">
                                        <th scope="col" class="px-3 py-1 text-center">
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-3 py-1 text-center">
                                            Especialidad
                                        </th>
                                        <th scope="col" class="px-3 py-1 text-center">
                                            Licencia
                                        </th>
                                        <th scope="col" class="px-3 py-1 text-center">
                                            
                                        </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                                <tr class="bg-gray-200 border-b">
                                    <td class="border p-2 text-center">{{ $doctor->user->name }}</td>
                                    <td class="border p-2 text-center">{{ $doctor->specialty->specialty }}</td>
                                    <td class="border p-2 text-center">{{ $doctor->license }}</td>
                                    <td class="border p-2 text-center">
                                        <a href="#" class="text-red-700 hover:text-red-500 hover:underline duration-300">
                                            Turnos disponibles 
                                        </a>                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-5">No hay doctores disponibles para esta especialidad.</p>
            @endif
        </div>

    

        
    </div>
</div>
