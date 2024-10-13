<div class="w-full h-8 bg-red-600">

</div>
<header class="w-full h-auto bg-white px-14 flex items-center justify-between">
        <img class="w-32" src="http://localhost:8000/img/Logo.png"/>
        <nav class="w-2/4 h-full">
            <ul class="flex items-center justify-between">
                <li class="text-xl hover:text-red-600 duration-300 cursor-pointer hover:scale-125">
                    <a href="{{ route('index') }}" wire:navigate>Inicio</a>
                </li>
                <li class="text-xl hover:text-red-600 duration-300 cursor-pointer hover:scale-125">
                    <a href="{{ route('services') }}" wire:navigate>Servicios</a>
                </li>
                <li class="text-xl hover:text-red-600 duration-300 cursor-pointer hover:scale-125">
                    <a href="{{ route('contact') }}" wire:navigate>Contacto</a>
                </li>
                <li class="text-xl hover:text-red-600 duration-300 cursor-pointer hover:scale-125">Login</li>
            </ul>
        </nav>
</header>