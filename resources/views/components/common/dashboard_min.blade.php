<div class="w-3/4 h-screen">
    <section class="">
        <div class="relative w-full h-24 px-14 flex items-center justify-between">


            <div class="relative w-44" x-data="{ isActive: false }" @click.outside="isActive = false">
                <button class="w-full p-3 bg-slate-300 hover:bg-slate-400 duration-300" @click="isActive = !isActive">
                    Menu <i class="fas fa-bars ml-2"></i>
                </button>
                <div class="absolute w-full" x-bind:class="{ 'active': isActive, 'inactive': !isActive }">
                    <ul class="flex flex-col items-center justify-between">
                        <li class="w-full cursor-pointer text-center p-2 bg-orange-400 hover:bg-orange-500 duration-300">
                            <a class="w-full h-full">Configuración <i class="fas fa-cogs ml-2"></i></a>
                        </li>

                        <li class="w-full cursor-pointer text-center text-white p-2 bg-red-600 hover:bg-red-700 duration-300">
                            <a wire:click="logout" class="w-full h-full">
                                Cerrar sesión <i class="fas fa-sign-out-alt ml-2"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </section>
</div>


