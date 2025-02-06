<div>
    <x-common.header/>

    <section class="w-full py-12 px-14 bg-gray-200">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-gray-800">Recuperar contraseña</h2>
            <div class="w-full mt-12 flex flex-col gap-7 items-center justify-between">
                <p class="text-lg text-gray-600 mt-4">Ingrese su correo electrónico y le enviaremos un link para cambiar su contraseña</p>
                <form wire:submit.prevent="sendMail" class="w-full">
                    <input wire:model="email" class="w-3/6 p-3 rounded-md border-b border-red-500" type="email" placeholder="Ingrese su correo..."/>
                    
                    <button class="w-3/6 mt-3 text-white bg-red-500 hover:bg-red-400 p-3 duration-300 rounded-md">Enviar <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </section>



    <x-common.footer/>
</div>

