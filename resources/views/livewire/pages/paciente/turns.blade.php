<div x-data="{ sidebarOpen: false, showModal: false, showModalTurn: false, turnId: null, doctorId: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />

   


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />


        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="relative w-full px-14 overflow-x-auto mt-20 flex justify-between">
                <div class="relative w-60 h-40 bg-red-500 rounded-lg overflow-hidden">
                    <h3 class="text-center my-3 text-xl">Turnos asignados</h3>
                    <i class="absolute -left-7 -bottom-7 text-9xl text-red-900 w-1/6 fas fa-calendar"></i>
                    <h3 class="absolute right-4 bottom-4 text-5xl px-3 py-2 text-center text-gray-900">
                        {{ $count_turns }}
                    </h3>
                </div>





            </div>



            <div class="relative w-full px-14 overflow-x-auto mb-7">
                <h3 class="px-3 py-1 text-center text-2xl mt-16 font-bold">Turnos programados</h3>




                <table class="w-full m-auto mt-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                    @if (count($turns) > 0)
                        <thead class="text-xs text-white uppercase bg-red-600 ">
                            <tr>
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
                                        {{ $turn['specialty'] }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        {{ $turn['doctor_name'] }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        {{ \Carbon\Carbon::parse($turn['date'])->format('d-m-Y') }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        {{ \Carbon\Carbon::parse($turn['time'])->format('h:i') }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        <button
                                            @click="showModalTurn = true, Livewire.dispatch('showTurnsAvailables', { doctorId: {{ $turn['doctor_id'] }} } );">
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

    <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg text-center">
            <h2 class="text-xl font-semibold mb-4">¿Estás seguro?</h2>
            <p class="mb-4">El turno será cancelado</p>
            <button @click="showModal = false; Livewire.dispatch('cancelConfirmed', { turnId }); turnId = null"
                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Sí, eliminar</button>
            <button @click="showModal = false" class="bg-gray-300 px-4 py-2 rounded-md">Cancelar</button>
        </div>
    </div>


    <div x-show="showModalTurn" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50">
        <div class="relative w-4/6 m-auto mt-28 bg-white p-6 rounded-lg text-center overflow-y-scroll">
            <button @click="showModalTurn = false" class="absolute top-4 right-4 text-black text-2xl"><i
                    class="fas fa-times"></i></button>
            <h2 class="text-2xl font-semibold mb-4">Reprogramar turno</h2>

            <div class="grid grid-cols-3 gap-3">
                @if (isset($turns_availables))
                    @foreach ($turns_availables as $date => $turns)
                        <div class="my-4">
                            <h3 class="text-lg font-bold">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h3>
                            <ul class="mt-2">
                                @foreach ($turns as $turn)
                                    <li class="border-2 bg-gray-300 p-2 my-1">
                                        <span
                                            class="mr-2">{{ \Carbon\Carbon::parse($turn->time)->format('h:i A') }}</span>
                                        <button @click="/* Aquí puedes manejar la lógica para seleccionar un turno */"
                                            class="text-blue-500 hover:underline">Seleccionar</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @else
                    <p>No hay turnos disponibles.</p>
                @endif
            </div>
        </div>
    </div>

</div>
