<div x-data="{ sidebarOpen: false }" class="relative flex h-screen bg-gray-100 overflow-hidden">


    <x-common.sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="w-full px-14 mt-20">
                <h2 class="text-center my-7 text-3xl">Turnos disponibles del Dr. {{ $name }}</h2>
               

                <div class="w-full grid gap-4 grid-cols-3 justify-items-center">
                    @foreach ($turns_availables as $date => $turns)
                        <div class="mb-6">
                            <h3 class="text-2xl my-3 font-bold text-center">
                                {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h3>
                            <div class="list-none pl-5 grid gap-3 grid-cols-2">
                                @foreach ($turns as $turn)
                                    <div onclick="confirmDelete({{ $turn->id }}, '{{ \Carbon\Carbon::parse($date)->translatedFormat('j \de F \de Y') }}', '{{ \Carbon\Carbon::parse($turn->time)->format('H:i') }}')"
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
</div>



<script>
    function confirmDelete(id, date, time) {
        Swal.fire({
            title: "¿Desea confirmar este turno?",
            text: `${date} a las ${time}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                console.log("Emitir evento Livewire");
                Livewire.dispatch('scheduleAppointmentConfirm', {
                    id
                });

                Swal.fire({
                    title: "Confirmado!",
                    text: `${date} a las ${time}`,
                    icon: "success"
                });
            }
        });
    }
</script>
