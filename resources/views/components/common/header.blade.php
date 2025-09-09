<div class="w-full h-2 bg-red-600"></div>


<header class="w-full py-3 bg-white shadow-md">
    <div class="w-full mx-auto px-14 flex items-center justify-between h-28">
 
        <a href="{{ route('index') }}" wire:navigate>
            <img class="w-20" src="http://localhost:8000/img/Logo.png" alt="Logo" />
        </a>

  
        <nav class="w-2/4">
            <ul class="flex items-center justify-between">
               
                <li class="text-xl font-medium text-gray-700 relative group cursor-pointer">
                    <a href="{{ route('index') }}" wire:navigate>Inicio</a>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-red-600 transition-all duration-300 group-hover:w-full"></span>
                </li>

                <li class="text-xl font-medium text-gray-700 relative group cursor-pointer">
                    <a href="{{ route('services') }}" wire:navigate>Servicios</a>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-red-600 transition-all duration-300 group-hover:w-full"></span>
                </li>

                <li class="text-xl font-medium text-gray-700 relative group cursor-pointer">
                    <a href="{{ route('contact') }}" wire:navigate>Contacto</a>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-red-600 transition-all duration-300 group-hover:w-full"></span>
                </li>

           
                <li class="text-xl font-medium text-gray-700 relative group cursor-pointer">
                    <a href="{{ route('login') }}" wire:navigate
                       class="px-5 py-2 bg-red-600 text-white rounded-full shadow-md hover:bg-red-700 transition duration-300">
                       Login
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
