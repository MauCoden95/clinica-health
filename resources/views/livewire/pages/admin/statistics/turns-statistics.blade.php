<div x-data="{
    turnsToday: @json($turnsToday),
    turnsWeek: @json($turnsWeek),
    turnsMonth: @json($turnsMonth),
    turnsBySpecialty: @json($turnsBySpecialty),
    
}">
    <h1 class="text-3xl font-bold mb-6">Informes y estadísticas</h1>
    <h2 class="text-2xl font-bold mb-6">📅Turnos</h2>
    @php
        $turnsToday = $this->count_turns_by_day();
        $turnsWeek = $this->count_turns_by_week();
        $turnsMonth = $this->count_turns_by_month();
        $turnsBySpecialty = $this->turns_by_specialty();
        $turnsByDoctor = $this->turns_by_doctor();
        $patientsByDoctor = $this->patients_by_doctor();
        $rankingDoctors = $this->ranking_doctors_by_turns();
        $workHoursVsAppointments = $this->getWorkHoursVsAppointments();
        $patientsActive = $this->getPatientsActive();
        $newPatients = $this->getNewPatients();
        $averageAppointmentsPerPatient = $this->getAverageAppointmentsPerPatient();
    @endphp
    <div class="flex gap-6 items-center justify-between">
        <div class="w-2/4">
            <x-common.graph.turns_day_week_month :turnsToday="$turnsToday" :turnsWeek="$turnsWeek" :turnsMonth="$turnsMonth" />
        </div>

        <div class="w-2/4">
            <x-common.graph.turns_by_specialty :turnsBySpecialty="$turnsBySpecialty" />

        </div>
    </div>



    <h2 class="text-2xl font-bold mt-20 mb-2">👨‍⚕️Profesionales de la salud</h2>
    <div class="flex gap-6 justify-between">
        <div class="w-2/4">
            <x-common.graph.turns_by_doctor :turnsByDoctor="$turnsByDoctor" />
        </div>

        <div class="w-2/4">
            <x-common.graph.patients_by_doctor :patientsByDoctor="$patientsByDoctor" />

        </div>
    </div>


    <div class="flex gap-6 justify-between">
        <div class="w-2/4">
            <x-common.graph.ranking_doctors_turns :rankingDoctors="$rankingDoctors" />
        </div>

        <div class="w-2/4">
            <x-common.graph.works_hours_vs_appintments :workHoursVsAppointments="$workHoursVsAppointments" />


        </div>
    </div>





    <h2 class="text-2xl font-bold mt-20 mb-2">🏥Pacientes</h2>
    <div class="flex gap-6 justify-between">
        <div class="w-2/4">
            <x-common.graph.patients_active :patientsActive="$patientsActive" />
        </div>

        <div class="w-2/4">
            <x-common.graph.new_patients :newPatients="$newPatients" />


        </div>
    </div>


    <div class="flex gap-6 justify-between">
        <div class="w-2/4">
            <x-common.graph.average_appointments_per_patient :averageAppointmentsPerPatient="$averageAppointmentsPerPatient" />
        </div>

        <div class="w-2/4">
            


        </div>
    </div>











</div>
</div>