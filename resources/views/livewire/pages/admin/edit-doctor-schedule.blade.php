<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />


    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">

            <div class="relative w-full mx-auto mt-8 px-14 py-10 rounded-lg shadow-md">
                <div class="w-full flex justify-between">
                    <h2 class="text-2xl font-semibold mb-20">Editar jornada del Dr. {{ $name_doctor }}</h2>
                    <a wire:navigate href="{{ route('admin.doctor') }}" class="text-xl">Volver a doctores</a>
                </div>





                <table class="w-3/6 bg-white mb-8">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-red-500 text-white border border-gray-700">Día de la semana</th>
                            <th class="py-2 px-4 bg-red-500 text-white border border-gray-700">Hora de inicio</th>
                            <th class="py-2 px-4 bg-red-500 text-white border border-gray-700">Hora de fin</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="py-2 px-4 border border-gray-700 text-center">
                                @switch($doctor_schedule->day_of_week)
                                    @case(1)
                                        Lunes
                                        @break
                                    @case(2)
                                        Martes
                                        @break
                                    @case(3)
                                        Miércoles
                                        @break
                                    @case(4)
                                        Jueves
                                        @break
                                    @case(5)
                                        Viernes
                                        @break
                                    @case(6)
                                        Sábado
                                        @break
                                    @default
                                        Desconocido
                                @endswitch
                            </td>
                            <td class="py-2 px-4 border border-gray-700 text-center">{{ \Carbon\Carbon::parse($doctor_schedule->start_time)->format('H:i') }}</td>
                            <td class="py-2 px-4 border border-gray-700 text-center">{{ \Carbon\Carbon::parse($doctor_schedule->end_time)->format('H:i') }}</td>
                            
                        </tr>

                    </tbody>
                </table>



                <form wire:submit.prevent="editDoctorSchedule({{ $doctor_schedule->id }})" class="grid grid-cols-2 gap-3">


                    <div>
                        <select wire:model="day_of_week" name="day_of_week" class="w-full p-3 border-b border-red-500">
                            <option value="">--Día de la semana--</option>
                            <option value="1">Lunes</option>
                            <option value="2">Martes</option>
                            <option value="3">Miércoles</option>
                            <option value="4">Jueves</option>
                            <option value="5">Viernes</option>
                            <option value="6">Sábado</option>
                        </select>
                    </div>

                    <div>
                        <input wire:model="start_time" min="08:00" max="20:00" class="w-full p-3 border-b border-red-500" type="time" name="start_time" placeholder="Hora de inicio..." />
                        @error('start_time') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <input wire:model="end_time" min="08:00" max="20:00" class="w-full p-3 border-b border-red-500" type="time" name="end_time" placeholder="Hora de fin..." />
                        @error('end_time') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>



                    <div class="w-full p-3">
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 duration-300">
                            Actualizar jornada del Doctor
                        </button>
                    </div>



                </form>
            </div>
        </main>
    </div>
</div>