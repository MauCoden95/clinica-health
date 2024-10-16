<div class="flex">
    <section class="w-1/4 h-screen bg-gray-200">

    </section>

    <section class="w-3/4 h-screen">
        <div class="w-full h-24 px-14 flex items-center justify-between">
            <h1 class="text-3xl font-bold">Bienvenido, {{ auth()->user()->name }}</h1>

         
            <button wire:click="logout" class="bg-red-600 text-white p-3 rounded-md hover:bg-red-800 duration-300">
                Cerrar sesión
            </button>
        </div>
    </section>
   
</div>
