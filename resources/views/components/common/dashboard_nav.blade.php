<div :class="{'block': sidebarOpen, 'hidden': !sidebarOpen}" class="absolute bg-white w-64 min-h-screen flex flex-col md:block">
    @if(auth()->user()->hasRole('paciente'))
        <x-common.patient_menu/>    
        @elseif(auth()->user()->hasRole('admin'))
            <x-common.admin_menu/>    
        @else
            <p>No tienes un rol asignado que sea administrador o editor.</p>
    @endif
</div>
