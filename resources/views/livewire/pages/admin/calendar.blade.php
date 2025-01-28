<div x-data="{ sidebarOpen: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />



    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 px-14 overflow-x-hidden overflow-y-auto bg-white">
            <div>
                <h1 class="text-4xl my-12 text-center font-bold">Turnos de hoy</h1>

                <table class="w-5/6 m-auto mb-20 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="border border-gray-300 bg-red-500 text-white p-2 text-center">PACIENTE</th>
                            <th class="border border-gray-300 bg-red-500 text-white p-2 text-center">HORA</th>
                            <th class="border border-gray-300 bg-red-500 text-white p-2 text-center">MEDICO</th>
                            <th class="border border-gray-300 bg-red-500 text-white p-2 text-center">ESPECIALIDAD</th>
                            <th class="border border-gray-300 bg-red-500 text-white p-2 text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($turns as $turn)
                        <tr class="">
                            <td class="border border-gray-300 p-2 text-center">{{ $turn['name_patient'] ?? 'N/A' }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ \Carbon\Carbon::parse($turn['time'])->format('H:i') ?? 'N/A' }}</td>
                            <td class="border border-gray-300 p-2 text-center">Dr. {{ $turn['doctor_name'] ?? 'N/A' }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $turn['specialty'] ?? 'N/A' }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <a wire:navigate 
                                    class="text-xl"><i class="fas fa-edit text-blue-600 hover:text-blue-400 duration-300"></i></a>
                                <button class="text-xl">
                                    <i class="fas fa-trash-alt ml-4 text-red-600 hover:text-red-400 duration-300"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 p-4">No hay turnos para mostrar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>


                <div x-data="{ calendar: 'monthly' }" class="w-5/6 m-auto mb-7">



                    <div id="calendar"></div>
                </div>





            </div>



            <div>


                <div x-data="{ calendar: 'monthly' }" class="w-5/6 m-auto my-20">
                    <h1 class="text-2xl my-7 text-center font-bold">Buscar turnos por médico o especialidad</h1>


                    <input wire:model.live="filter" type="text" placeholder="Ingrese Nombre Médico o Especialidad"
                        class="w-full p-2 border border-gray-300 active:border-red-500 rounded-md">
                </div>





            </div>



            <div class="w-5/6 m-auto">

                <x-common.statistics :occupationDay="$occupation_day" :topThreeSpecialties="$topThreeSpecialties" :topThreeDoctors="$topThreeDoctors" :patients="$patients" />


            </div>




        </main>
    </div>
</div>



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/es.js"></script>

<script>
    let calendar;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            dayCellClassNames: function(arg) {
                if (arg.date.getMonth() !== new Date().getMonth()) {
                    return 'bg-gray-200 text-gray-400';
                }
                return '';
            },
            dateClick: function(info) {
                alert(info.dateStr);
            }
        });

        calendar.render();
    });

    function updateCalendarView(view) {
        if (calendar) {
            calendar.changeView(view);
        }
    }
</script>
@endpush