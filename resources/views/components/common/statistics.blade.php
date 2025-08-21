<div x-data="{ calendar: 'monthly' }" class=" m-auto my-20">
    <h1 class="text-2xl my-7 text-center font-bold">Estadísticas de Turnos</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-xl">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Ocupación Diaria</h2>
            <div class="flex flex-col items-start space-y-3">
                <span class="text-3xl font-extrabold text-blue-600 dark:text-blue-400">{{ ceil($occupationDay) }}%</span>
                <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-500 ease-in-out" style="width: {{ $occupationDay ?? 0 }}%;"></div>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Porcentaje de turnos ocupados hoy.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-xl">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Especialidades más Demandadas</h2>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($topThreeSpecialties as $specialty)
                <li class="py-3 flex items-center justify-between">
                    <span class="text-base text-gray-700 dark:text-gray-200 font-medium">{{ $specialty->specialty }}</span>
                    <span class="text-base font-bold text-green-600 dark:text-green-400">{{ $specialty->total }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-xl">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Doctores con más Turnos</h2>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($topThreeDoctors as $doctor)
                <li class="py-3 flex items-center justify-between">
                    <span class="text-base text-gray-700 dark:text-gray-200 font-medium">{{ $doctor->name }}</span>
                    <span class="text-base font-bold text-green-600 dark:text-green-400">{{ $doctor->total }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-xl">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Pacientes Recurrentes (Último mes)</h2>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($patients as $patient)
                <li class="py-3 flex items-center justify-between">
                    <span class="text-base text-gray-700 dark:text-gray-200 font-medium">{{ $patient->name }}</span>
                    <span class="text-base font-bold text-green-600 dark:text-green-400">{{ $patient->total }}</span>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
</div>