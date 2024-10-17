<section class="relative w-1/4 h-screen navbar_dashboard">
    <img class="absolute -top-5 left-1/2 transform -translate-x-1/2 w-36 m-auto" src="http://localhost:8000/img/Logo.png"/>
        @if(auth()->user()->hasRole('paciente'))
            <x-common.patient_menu/>    
        @elseif(auth()->user()->hasRole('editor'))
            <p>Tienes el rol de <strong>Editor</strong>.</p>
        @else
            <p>No tienes un rol asignado que sea administrador o editor.</p>
        @endif
</section>