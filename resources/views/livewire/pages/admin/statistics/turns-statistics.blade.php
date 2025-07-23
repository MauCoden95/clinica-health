<div>
    <h1 class="text-3xl font-bold mb-6">Informes y estadísticas</h1>
    <h2 class="text-2xl font-bold mb-6">Turnos</h2>
    @php
        $turnsToday = $this->count_turns_by_day();
        $turnsWeek = $this->count_turns_by_week();
        $turnsMonth = $this->count_turns_by_month();
        $turnsBySpecialty = $this->turns_by_specialty();
        $turnsByDoctor = $this->turns_by_doctor();
    @endphp
    <div class="flex gap-6">
        <div class="bg-gray-200 shadow-md rounded-xl p-6 border-l-8 border-red-600">
            <h2 class="text-xl font-bold text-red-600 mb-2">Turnos de Hoy</h2>
            <p class="text-4xl font-extrabold text-gray-800">
                {{ $turnsToday }}
            </p>
        </div>

        <div class="bg-gray-200 shadow-md rounded-xl p-6 border-l-8 border-red-600">
            <h2 class="text-xl font-bold text-red-600 mb-2">Turnos de esta semana</h2>
            <p class="text-4xl font-extrabold text-gray-800">
                {{ $turnsWeek }}
            </p>
        </div>

        <div class="bg-gray-200 shadow-md rounded-xl p-6 border-l-8 border-red-600">
            <h2 class="text-xl font-bold text-red-600 mb-2">Turnos del mes</h2>
            <p class="text-4xl font-extrabold text-gray-800">
                {{ $turnsMonth }}
            </p>
        </div>
    </div>











    <div>
        <h2 class="text-xl text-center font-bold mt-12">Turnos por especialidad</h2>
        <table class="mt-10 w-full">
            <thead>
                <tr class="bg-red-500 text-white">
                    <th class="px-3 py-1 text-center">Especialidad</th>
                    <th class="px-3 py-1 text-center">Cantidad de turnos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnsBySpecialty as $specialty => $count)
                    <tr class="bg-gray-200 border-b">
                        <td class="px-3 py-1 text-center">{{ $specialty }}</td>
                        <td class="px-3 py-1 text-center">{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>








    <div>
        <h2 class="text-xl text-center font-bold mt-12">Turnos por doctor</h2>
        <table class="mt-10 w-full mb-12">
            <thead>
                <tr class="bg-red-500 text-white">
                    <th class="px-3 py-1 text-center">Doctor</th>
                    <th class="px-3 py-1 text-center">Cantidad de turnos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turnsByDoctor as $doctor => $count)
                    <tr class="bg-gray-200 border-b">
                        <td class="px-3 py-1 text-center">{{ $doctor }}</td>
                        <td class="px-3 py-1 text-center">{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>