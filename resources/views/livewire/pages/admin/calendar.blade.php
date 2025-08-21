<div x-data="{ sidebarOpen: false, editTurn: false, oldTurnId: 9  }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />



    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 px-14 overflow-x-hidden overflow-y-auto bg-white">
            <div>
                <h1 class="text-4xl my-12 text-center font-bold">Turnos de hoy</h1>


                <div class="overflow-x-auto rounded-lg shadow-md mb-20">
                    <table class="min-w-full leading-normal">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Paciente
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Hora
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Médico
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Especialidad
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($turns as $turn)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-300 ease-in-out">
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $turn['name_patient'] ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($turn['time'])->format('H:i') ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">Dr. {{ $turn['doctor_name'] ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $turn['specialty'] ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm font-medium">
                                    <button @click="editTurn = true; old_turn_id = {{ $turn['id'] }};"
                                        wire:click="getTurnsAvailables({{ $turn['doctor_id'] }})"
                                        class="text-xl text-blue-600 hover:text-blue-400 duration-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-xl ml-4 text-red-600 hover:text-red-400 duration-300">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-5 py-4 text-center text-lg text-gray-600 dark:text-gray-400">
                                    No hay turnos para mostrar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{--
                <div x-data="{ calendar: 'monthly' }" class="w-5/6 m-auto mb-7">



                    <div id="calendar"></div>
                </div>

--}}



            </div>



            <div>


                <div x-data="{ calendar: 'monthly' }" class="w-6/6 m-auto my-20">
                    <h1 class="text-2xl my-7 text-center font-bold">Buscar turnos por paciente, médico o especialidad</h1>


                    <input wire:model.live="inputSearch" type="text" placeholder="Ingrese Nombre Médico o Especialidad"
                        class="w-full p-2 border border-gray-300 active:border-red-500 rounded-md mb-12">

                    <table class="min-w-full leading-normal">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Paciente
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Fecha
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Hora
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Médico
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Especialidad
                                </th>
                                <th scope="col" class="px-5 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider text-left">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($turns_today as $turn)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-300 ease-in-out">
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $turn['name_patient'] ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($turn['date'])->format('d-m-Y') ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($turn['time'])->format('H:i') ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">Dr. {{ $turn['doctor_name'] ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-900">{{ $turn['specialty'] ?? 'N/A' }}</td>
                                <td class="px-5 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        @click="editTurn = true; oldTurnId = {{ $turn['id'] }};"
                                        wire:click="getTurnsAvailables({{ $turn['doctor_id'] }})"
                                        class="text-xl text-blue-600 hover:text-blue-400 duration-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        @click="confirmDelete = true; turnIdToDelete = {{ $turn['id'] }}"
                                        class="text-xl ml-4 text-red-600 hover:text-red-400 duration-300">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-5 py-4 text-center text-lg text-gray-600 dark:text-gray-400">
                                    No hay turnos para hoy.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>





            </div>



            <div class="w-5/6 m-auto">

                <x-common.statistics :occupationDay="$occupation_day" :topThreeSpecialties="$topThreeSpecialties" :topThreeDoctors="$topThreeDoctors" :patients="$patients" />


            </div>



            {{-- Modal para editar turno --}}
            <div x-show="editTurn" class="w-full fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-start justify-center py-10">
                <div class="w-5/6 max-h-[80vh] bg-white rounded-lg text-center flex flex-col">
                    <h2 class="text-xl font-semibold p-4 border-b sticky top-0 bg-white z-10">Editar turno</h2>
                    <div class="w-full p-6 overflow-y-auto flex-1">
                        <div class="grid gap-4 grid-cols-3 justify-items-center">
                            @foreach ($turns_availables as $date => $turns)
                            <div class="mb-6">
                                <h3 class="text-2xl my-3 font-bold text-center">
                                    {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                                </h3>
                                <div class="list-none pl-5 grid gap-3 grid-cols-2">
                                    @foreach ($turns as $turn)
                                    <button wire:click="editTurn({{ $turn->id }}, {{ $oldTurnId }})"
                                        class="cursor-pointer text-center w-24 p-2 my-3 rounded-md bg-red-600 hover:bg-red-900 text-white duration-300">
                                        {{ \Carbon\Carbon::parse($turn->time)->format('H:i') }}
                                    </button>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 border-t flex justify-end sticky bottom-0 bg-white">
                        <button @click="editTurn = false" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cerrar
                        </button>
                    </div>
                </div>
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