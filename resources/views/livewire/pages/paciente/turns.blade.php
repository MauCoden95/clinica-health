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
                                        {{ $turn['time'] }}
                                    </td>
                                    <td class="px-3 py-2 text-center text-gray-900">
                                        <button>
                                            <i
                                                class="fas fa-edit text-xl duration-300 text-blue-500 hover:text-blue-700"></i>
                                        </button>

                                        <button>
                                            <i
                                                class="fas fa-trash text-xl ml-3 duration-300 text-red-500 hover:text-red-700"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p class="text-gray-600 text-2xl">No hay turnos disponibles.</p>
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
</div>
