<div x-data="{ calendar: 'monthly' }" class=" m-auto my-20">
    <h1 class="text-2xl my-7 text-center font-bold">Estadísticas de Turnos</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
        <div class="bg-white rounded-lg p-4 shadow-md">
            <h2 class="text-lg font-bold mb-2">Ocupación Diaria</h2>
            <div class="flex flex-col">
                <span class="text-xl font-bold"> {{ ceil($occupationDay) }}%</span>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{$occupationDay ?? 0}}%"></div>
                </div>

            </div>
        </div>

      

        <div class="bg-white rounded-lg p-4 shadow-md">
            <h2 class="font-bold mb-2">Especialidades más Demandadas</h2>
            <table class="w-full">
                <tbody class="bg-white">
                    @foreach ($topThreeSpecialties as $specialty)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-gray-900">{{ $specialty->specialty }} </div>
                                    <div class="ml-2 text-sm leading-5 font-medium text-gray-900"> {{ $specialty->total }} turnos asignados</div>
                                </div>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="bg-white rounded-lg p-4 shadow-md">
            <h2 class="font-bold mb-2">Doctores con más Turnos</h2>
            <table class="w-full">
                <tbody class="bg-white">
                @foreach ($topThreeDoctors as $doctor)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-gray-900">{{ $doctor->name }} </div>
                                    <div class="ml-2 text-sm leading-5 font-medium text-gray-900"> {{ $doctor->total }} turnos asignados</div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="bg-white rounded-lg p-4 shadow-md">
            <h2 class="font-bold mb-2">Pacientes que han reservado más de un turno el ultimo mes</h2>
            <table class="w-full">
                <tbody class="bg-white">
                @foreach ($patients as $patient)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm leading-5 font-medium text-gray-900">{{ $patient->name }} </div>
                                    <div class="ml-2 text-sm leading-5 font-medium text-gray-900"> {{ $patient->total }} turnos asignados</div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>