<div>
    <x-common.header/>

    <section class="w-full py-16 px-6 bg-gray-100 flex justify-center">
        <div class="max-w-md w-full bg-white p-10 rounded-xl shadow-lg text-center flex flex-col items-center">
            
            <!-- Imagen decorativa arriba -->
            <img src="http://localhost:8000/img/password-recovery.png" alt="Recuperar contraseña" class="w-72 mb-6" />

            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Recuperar contraseña</h2>
            <p class="text-gray-600 mb-8">
                Ingrese su correo electrónico y le enviaremos un link para cambiar su contraseña
            </p>

            <form wire:submit.prevent="sendMail" class="w-full flex flex-col gap-4">
                <input 
                    wire:model="email" 
                    type="email" 
                    placeholder="Ingrese su correo..." 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-red-500 transition" 
                />

                <button 
                    type="submit" 
                    class="w-full p-3 bg-red-500 text-white rounded-md hover:bg-red-600 transition flex items-center justify-center gap-2"
                >
                    Enviar
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </section>

    <x-common.footer/>
</div>
