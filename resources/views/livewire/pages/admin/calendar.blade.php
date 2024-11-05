<div x-data="{ sidebarOpen: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <div :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
        class="fixed inset-0 bg-white w-full h-full transform transition-transform duration-300 z-50 md:relative md:translate-x-0 md:w-64 md:h-auto md:flex md:flex-col">



        <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-gray-600 md:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>





        <x-common.dashboard_nav />
    </div>



    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div>
                <div id="calendar"></div>

                @push('styles')
                    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">
                @endpush

                @push('scripts')
                    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
                    <script>
                        document.addEventListener('livewire:load', function() {
                            var calendarEl = document.getElementById('calendar');
                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                selectable: true,
                                events: @json($events),
                                dateClick: function(info) {
                                    @this.showTurns(info.date);
                                },
                            });
                            calendar.render();
                        });

                        Livewire.on('turnsUpdated', function(turns) {
                            let turnsList = document.getElementById('turns-list');
                            turnsList.innerHTML = ''; 

                            turns.forEach(turn => {
                                let li = document.createElement('li');
                                li.innerText =
                                    `Paciente: ${turn.user.name}, Médico: ${turn.doctor.user.name}, Especialidad: ${turn.doctor.specialty.specialty}, Fecha: ${turn.date}, Hora: ${turn.time}`;
                                turnsList.appendChild(li);
                            });
                        });
                    </script>
                @endpush

                <div id="turns-container">
                    <h3>Turnos del día: {{ $selectedDate }}</h3>
                    <ul id="turns-list">
                        @foreach ($turns as $turn)
                            <li>
                                Paciente: {{ $turn->user->name }}, Médico: {{ $turn->doctor->user->name }},
                                Especialidad: {{ $turn->doctor->specialty->specialty }}, Fecha: {{ $turn->date }},
                                Hora: {{ $turn->time }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </main>
    </div>
</div>
