<div x-data="{ sidebarOpen: false, isConfirmed: false, turnId: 0, date: '', time: '', showModal: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">

    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="w-full px-14 mt-20">
                <h2 class="text-center my-7 text-3xl">Turnos disponibles de Dr. {{ $name }}</h2>

                <div class="w-full grid gap-4 grid-cols-3 justify-items-center">
                    @foreach ($turns_availables as $date => $turns)
                    <div class="mb-6">
                        <h3 class="text-2xl my-3 font-bold text-center">
                            {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}
                        </h3>
                        <div class="list-none pl-5 grid gap-3 grid-cols-2">
                            @foreach ($turns as $turn)
                            <div @click="isConfirmed = true; turnId = {{ $turn->id }}; date = '{{ $turn->date }}'; time = '{{ $turn->time }}'; confirmTurn({{ $turn->id }}, '{{ $turn->date }}', '{{ $turn->time }}')"
                                class="cursor-pointer text-center w-24 p-2 my-3 rounded-md bg-red-600 hover:bg-red-900 text-white duration-300">
                                {{ \Carbon\Carbon::parse($turn->time)->format('H:i') }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

    {{-- Modal para confirmar el turno --}}
    <div x-show="isConfirmed == true" class="fixed inset-0 bg-gray-900 bg-opacity-90 flex items-center justify-center z-50">
        <div class="relative m-auto w-64 bg-white p-4 rounded-lg text-center overflow-y-auto max-h-[80vh]">
            <h2 class="text-center my-2 text-xl font-bold">¿Confirmar turno?</h2>
            <h4 class="text-center my-2">
                <span x-text="date.split('-').reverse().join('-')"></span> a las <span x-text="time.split(':').slice(0, 2).join(':')"></span>
            </h4>
            <div class="w-full py-3 flex items-center justify-between">
                <button
                    @click="Livewire.dispatch('scheduleAppointmentConfirm', { turnId }); isConfirmed = false; date = ''; time = ''; showModal = true; Swal.fire('Turno confirmado', '', 'success');"
                    class="bg-red-600 hover:bg-red-800 duration-300 text-white rounded-md p-3">
                    Confirmar
                </button>
                <button @click="isConfirmed = false" class="bg-gray-600 hover:bg-gray-800 duration-300 text-white rounded-md p-3">
                    Cancelar
                </button>
            </div>
        </div>
    </div>

    

    

</div>