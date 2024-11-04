<div class="">
    <div class="w-full m-auto flex items-center justify-center h-24 border-b-2">
        <img class="w-28" src="{{ asset('img/Logo.png') }}" alt="Logo" />
    </div>
    <nav class="w-full h-auto duration-300">
        <li class="list-none text-center italic text-xl my-3">Menú Administrador</li>

        <ul class="p-4 space-y-2">
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/pacientes">
                    <i class="fas fa-user w-5 h-5 mr-2"></i>
                    Pacientes
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/doctores">
                    <i class="fas fa-user-md w-5 h-5 mr-2"></i>
                    Médicos
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate href="http://localhost:8000/admin/especialidades">
                    <i class="fas fa-notes-medical w-5 h-5 mr-2"></i>
                    Especialidades
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate>
                    <i class="fas fa-calendar-alt w-5 h-5 mr-2"></i>
                    Calendario General
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate>
                    <i class="fas fa-chart-pie w-5 h-5 mr-2"></i>
                    Informes y Estadísticas
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate>
                    <i class="fas fa-id-card w-5 h-5 mr-2"></i>
                    Permisos de Usuarios
                </a>
            </li>
            <li>
                <a class="flex items-center px-4 py-2 text-gray-700 rounded-md hover:bg-gray-300 duration-300"
                    wire:navigate>
                    <i class="fas fa-clipboard-list w-5 h-5 mr-2"></i>
                    Inventario Médico
                </a>
            </li>
        </ul>
    </nav>
</div>
