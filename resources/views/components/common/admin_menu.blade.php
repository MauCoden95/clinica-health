<div class="">
    <div class="w-full m-auto flex items-center justify-center h-24">
        <img class="w-28" src="{{ asset('img/Logo.png') }}" alt="Logo" />
    </div>
    <nav class="w-full h-auto duration-300">
        <li class="list-none text-center italic text-xl my-3">Menú Administrador</li>

        <ul class="p-4 space-y-2">
            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/pacientes">
                    <i class="fas fa-user w-5 h-5 mr-2"></i>
                    Pacientes
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/doctores">
                    <i class="fas fa-user-md w-5 h-5 mr-2"></i>
                    Médicos
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/especialidades">
                    <i class="fas fa-notes-medical w-5 h-5 mr-2"></i>
                    Especialidades
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/calendario-de-turnos">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-2"></i>
                    Calendario General
                </a>
            </li>
            <li>
                <a wire:navigate href="http://localhost:8000/admin/quejas-y-sugerencias"
                    class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                    Quejas y sugerencias
                </a>
            </li>
            <li>
                <a wire:navigate href="http://localhost:8000/admin/estadisticas" class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate>
                    <i class="fas fa-chart-pie w-5 h-5 mr-2"></i>
                    Informes y Estadísticas
                </a>
            </li>
            

            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/inventario">
                    <i class="fas fa-clipboard-list w-5 h-5 mr-2"></i>
                    Inventario Médico
                </a>
            </li>

            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="{{ route('admin.suppliers') }}">
                    <i class="fas fa-truck w-5 h-5 mr-2"></i>
                    Proveedores
                </a>
            </li>

            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/finanzas">
                    <i class="fas fa-money-bill-wave-alt w-5 h-5 mr-2"></i>
                    Finanzas
                </a>
            </li>


            <li>
                <a class="flex items-center px-4 py-1.5 text-sm text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/usuarios">
                    <i class="fas fa-key w-5 h-5 mr-2"></i>
                    Usuarios
                </a>
            </li>
        </ul>
    </nav>
</div>
