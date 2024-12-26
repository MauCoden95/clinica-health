<div x-data="{ sidebarOpen: false, showModal: false, confirmReschedule: false, showModalTurn: false, turnId: null, doctorId: false, dateEdit: '', timeEdit: '', oldTurnId: 0, newTurnId:0 }" class="relative flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />




    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />


        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <x-common.count :item="'Turnos asignados'" :quantity="$count_turns" :icon="'fas fa-calendar'" />
            </div>


            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Turnos programados</h3>



                {{-- Tabla de turnos agendados --}}
                <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                    @if (count($turns) > 0)
                    <thead class="text-xs text-white uppercase bg-red-600 ">
                        <tr>
                            <th scope="col" class="px-3 py-1 text-center">
                                ID
                            </th>
                            <th scope="col" class="px-3 py-1 text-center">
                                Especialidad
                            </th>
                            <th scope="col" class="px-3 py-1 text-center">
                                Nombre del Doctor
                            </th>
                            <th scope="col" class="px-3 py-1 text-center">
                                Fecha
                            </th>
                            <th scope="col" class="px-3 py-1 text-center">
                                Hora
                            </th>
                            <th scope="col" class="px-3 py-1 text-center">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($turns as $turn)
                        <tr class="bg-gray-200 border-b ">
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ $turn['id'] }}
                            </td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ $turn['specialty'] }}
                            </td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ $turn['doctor_name'] }}
                            </td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ \Carbon\Carbon::parse($turn['date'])->format('d-m-Y') }}
                            </td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                {{ \Carbon\Carbon::parse($turn['time'])->format('H:i') }}
                            </td>
                            <td class="px-3 py-2 text-center text-gray-900">
                                <button
                                    @click="showModalTurn = true, Livewire.dispatch('showTurnsAvailables', { doctorId: {{ $turn['doctor_id'] }} } ); oldTurnId = {{ $turn['id'] }};">
                                    <i
                                        class="fas fa-calendar text-xl duration-300 text-blue-500 hover:text-blue-700"></i>
                                </button>

                                <button>
                                    <i @click="showModal = true, turnId = {{ $turn['id'] }}"
                                        class="fas fa-trash text-xl ml-3 duration-300 text-red-500 hover:text-red-700"></i>

                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p class="text-gray-600 text-2xl">No hay turnos agendados.</p>
                        @endif

                    </tbody>
                </table>
            </div>



            <div class="w-full px-14 my-20">
                <h2 class="text-center my-7 text-3xl">Buscar médico por especialidad</h2>

                <h4 class="text-center my-5">En cada medico podrá ver los turnos disponibles</h4>


                <select id="options" wire:model.change="specialtyId" name="specialtyName"
                    class="w-3/6 p-3 border-b border-red-500">
                    <option value="">--Especialidad--</option>
                    @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->specialty }}</option>
                    @endforeach
                </select>




                @if ($doctors && count($doctors) > 0)
                {{-- Tabla de doctores --}}
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
                                Matrícula
                            </th>
                            <th scope="col" class="px-3 py-1 text-center">


                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                        <tr class="bg-gray-200 border-b">
                            <td class="border p-2 text-center">{{ $doctor->user->name }}</td>
                            <td class="border p-2 text-center">{{ $doctor->specialty->specialty }}</td>
                            <td class="border p-2 text-center">{{ $doctor->license }}</td>
                            <td class="border p-2 text-center">
                                <a href="http://localhost:8000/pacientes/turnos-medico/{{ $doctor->id }}"
                                    wire:navigate
                                    class="text-red-700 hover:text-red-500 hover:underline duration-300">
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



        </main>
    </div>










    {{-- Modal para confirmar cancelacion de turno --}}
    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
            <p class="mb-4">El turno será cancelado</p>
            <button @click="showModal = false; Livewire.dispatch('cancelConfirmed', { turnId }); turnId = null"
                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, eliminar</button>
            <button @click="showModal = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>









    {{-- Modal para reprogramar turno --}}
    <div x-show="showModalTurn" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50">
        <div class="relative w-4/6 m-auto mt-20 bg-white p-6 rounded-lg text-center overflow-y-auto  max-h-[80vh]">
            <button @click="showModalTurn = false" class="absolute top-4 right-4 text-black text-2xl"><i
                    class="fas fa-times"></i></button>
            <h2 class="text-2xl font-semibold mb-4">Reprogramar turno</h2>



            <div class="grid grid-cols-5 gap-7">
                @if (isset($turns_availables))
                @foreach ($turns_availables as $date => $turns)
                <div class="my-4">
                    <h3 class="text-lg font-bold">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h3>
                    <div class="mt-2">
                        @foreach ($turns as $turn)
                        <button
                            @click="confirmReschedule = true; dateEdit = '{{ \Carbon\Carbon::parse($date)->format('Y-m-d') }}'; timeEdit = '{{ \Carbon\Carbon::parse($turn->time)->format('H:i') }}'; newTurnId = {{ $turn->id }}"
                            class="w-full border-2 bg-red-500 hover:bg-red-700 text-white duration-300 p-2 my-1">
                            <span
                                class="mr-2">{{ \Carbon\Carbon::parse($turn->time)->format('H:i') }}</span>

                        </button>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @else
                <p>No hay turnos disponibles.</p>
                @endif
            </div>
        </div>
    </div>






















    {{-- Modal para confirmar reprogramacion de turno --}}
    {{-- Modal para confirmar reprogramacion de turno --}}
    <div x-show="confirmReschedule" class="fixed inset-0 bg-gray-900 bg-opacity-90 flex items-center justify-center z-50">
        <div class="relative m-auto w-64 bg-white p-4 rounded-lg text-center overflow-y-auto max-h-[80vh]">
            <h2 class="text-center my-2 text-xl font-bold">¿Confirmar turno?</h2>
            <h4 class="text-center my-2">
                <span x-text="dateEdit.split('-').reverse().join('-')"></span> a las <span x-text="timeEdit"></span>
                <span x-text="newTurnId"></span>
            </h4>
            <div class="w-full py-3 flex items-center justify-between">
                <button
                    @click="if (newTurnId !== 0) { Livewire.dispatch('editNewTurn', { oldTurnId: oldTurnId, newTurnId: newTurnId, date: dateEdit, time: timeEdit }); confirmReschedule = false; }"
                    class="bg-red-600 hover:bg-red-800 duration-300 text-white rounded-md p-3">
                    Confirmar
                </button>
                <button @click="confirmReschedule = false" class="bg-gray-600 hover:bg-gray-800 duration-300 text-white rounded-md p-3">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

</div>