<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 overflow-hidden">

    <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
        class="bg-white w-64 min-h-screen flex flex-col md:block">
        <div class="flex items-center justify-center h-24 border-b">
            <img class="w-28" src="http://localhost:8000/img/Logo.png" />
        </div>
        <x-common.dashboard_nav />
    </div>

    <div class="flex-1 flex flex-col overflow-hidden">
        <x-common.header_dashboard />

        <main class="w-full flex-1 overflow-x-hidden overflow-y-auto bg-white">
            <div class="w-full px-14 mt-20">
                <h2 class="text-center my-7 text-3xl">Turnos disponibles del Dr. {{ $name }}</h2>

                <div class="w-full grid gap-4 grid-cols-3 justify-items-center">
                     @foreach ($turns_availables as $date => $turns)
                        <div class="mb-6">
                            <h3 class="text-2xl my-3 font-bold text-center">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</h3>
                            <div class="list-none pl-5 grid gap-3 grid-cols-2">
                                @foreach ($turns as $turn)
                                    <div class="cursor-pointer text-center w-24 p-2 my-3 rounded-md bg-red-600 hover:bg-red-900 text-white duration-300">
                                        {{ \Carbon\Carbon::parse($turn->time)->format('H-i') }}
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
