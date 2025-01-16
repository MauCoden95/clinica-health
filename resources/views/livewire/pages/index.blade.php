<div>
    <x-common.header/>

    <section class="relative w-full min-h-[450px] z-30 py-5 md:py-0 px-8 md:px-14 flex flex-col md:flex-row items-center justify-center">
        <div class="w-full md:w-2/4 mb-8 md:mb-0">
            <h2 class="text-2xl md:text-4xl mb-4 md:mb-6 text-center md:text-left">Cuidamos tu salud, <span class="font-bold">transformamos tu vida.</span></h2>
            <p class="text-sm md:text-base text-center md:text-left">
                En nuestra clínica, tu salud es nuestra prioridad. Ofrecemos atención médica integral con profesionales dedicados y tecnología de vanguardia. Nos comprometemos a brindarte un cuidado personalizado y de calidad, asegurando tu bienestar en cada paso del camino.
            </p>
        </div>
        <img class="w-4/5 md:w-2/5 mt-6 md:mt-0" src="http://localhost:8080/img/Banner1.png" alt="Dos médicos" />
    </section>


    <section class="relative w-full h-auto z-30 py-8 md:py-14 px-8 md:px-14 flex flex-col md:flex-row flex-wrap md:flex-nowrap gap-4 md:gap-6 items-center justify-center">
        <div class="w-full sm:w-1/2 md:w-1/4 h-auto md:h-72 bg-red-700 p-4 rounded-lg mb-4 md:mb-0">
            <h4 class="font-bold text-lg md:text-base text-white">
                <i class="fas fa-home"></i>
                Atención a Domicilio
            </h4>
            <p class="my-3 md:my-7 text-sm md:text-base text-white">
                Brindamos servicios médicos en la comodidad de tu hogar
            </p>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/4 h-auto md:h-72 bg-red-800 p-4 rounded-lg mb-4 md:mb-0">
            <h4 class="font-bold text-lg md:text-base text-white">
                <i class="fas fa-stethoscope"></i>
                Consultas Especializadas
            </h4>
            <p class="my-3 md:my-7 text-sm md:text-base text-white">
                Contamos con un equipo de especialistas en diversas áreas de la salud
            </p>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/4 h-auto md:h-72 bg-red-700 p-4 rounded-lg mb-4 md:mb-0">
            <h4 class="font-bold text-lg md:text-base text-white">
                <i class="fas fa-microscope"></i>
                Exámenes y Diagnósticos
            </h4>
            <p class="my-3 md:my-7 text-sm md:text-base text-white">
                Ofrecemos una amplia gama de pruebas diagnósticas
            </p>
        </div>

        <div class="w-full sm:w-1/2 md:w-1/4 h-auto md:h-72 bg-red-800 p-4 rounded-lg">
            <h4 class="font-bold text-lg md:text-base text-white">
                <i class="fas fa-heartbeat"></i>
                Programas de Prevención
            </h4>
            <p class="my-3 md:my-7 text-sm md:text-base text-white">
                Implementamos programas de bienestar para promover estilos de vida saludables
            </p>
        </div>
    </section>

    <section class="w-full min-h-[450px] z-30 px-8 md:px-14 mb-16 sm:mb-24 md:my-32">
        <h3 class="nanum text-3xl sm:text-4xl md:text-5xl text-center my-8 sm:my-10 md:my-12">Nuestros servicios</h3>

        <div class="swiper">
            <div class="w-5/6 swiper-wrapper px-2 mb-5">
                @foreach($services as $service)
                    <div class="swiper-slide card_services bg-base-100 w-1/4 p-2 sm:p-3 rounded-md mt-3 duration-300">
                        <figure>
                            <img src="{{ $service['image'] }}" alt="{{ $service['atl'] }}" class="w-full h-auto" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-center my-2 sm:my-3 md:my-4 text-lg sm:text-xl font-bold">{{ $service['specialty'] }}</h2>
                            <p class="p-2 sm:p-3 text-sm sm:text-base">{{ $service['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            
            </div>
        <div class="swiper-pagination"></div>
    </div>

        <div class="grid gap-4 sm:gap-5 md:gap-7 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
         
        </div>
    </section>


    <section class="relative w-full h-auto px-8 md:px-16 lg:px-28 my-8 sm:my-12 md:my-16 lg:my-20">
        <h2 class="nanum text-2xl md:text-2xl lg:text-5xl text-center mb-4 sm:mb-6">
            Nuestro Compromiso
        </h2>
        <blockquote class="mt-2 sm:mt-4">
            <p class="text-sm sm:text-base md:text-lg">
                <span class="font-bold">En nuestra clínica, estamos comprometidos con brindar una atención médica de vanguardia</span>, siempre centrada en las necesidades de nuestros pacientes. Creemos en la importancia de la innovación tecnológica y el trato humano para ofrecer un cuidado integral y personalizado. Nuestro equipo médico trabaja incansablemente para garantizar el bienestar de cada persona que confía en nosotros, asegurando que reciban el mejor tratamiento en un ambiente cálido y profesional.
            </p>
            <cite class="block text-right mt-2 sm:mt-4 text-sm sm:text-base italic">Carlos - Director General</cite>
        </blockquote>
    </section>



    <section class="w-full min-h-[450px] z-30 px-8 md:px-14 mt-24 mb-16 sm:mb-24 md:mb-32">
        <h3 class="nanum text-3xl sm:text-4xl md:text-5xl text-center my-8 sm:my-10 md:my-12">Innovación</h3>

        <div class="flex gap-8 flex-col md:flex-row items-center justify-between">
            <div class="w-full md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-xl sm:text-2xl font-bold mb-4">Innovación al Servicio de tu Salud</h2>
                <p class="text-base sm:text-lg my-4">
                    Nuestra clínica incorpora tecnología y enfoques modernos para garantizar una atención médica avanzada, cómoda y eficiente.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-7">
                    <ul>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Consulta con nuestros especialistas desde cualquier lugar.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Accede a tu información médica de forma rápida y segura.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Tecnología de última generación para diagnósticos precisos.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Seguimiento continuo de pacientes crónicos desde sus hogares.</span>
                        </li>
                    </ul>
              
                    <ul>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Gestiona tus citas y resultados de manera fácil y rápida.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Tratamientos modernos y eficaces para distintas patologías.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Protocolos de atención diseñados según las necesidades individuales.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-xs sm:text-sm">Programas preventivos basados en datos y análisis predictivo.</span>
                        </li>
                    </ul>
                </div>
            </div>
            <img class="w-full md:w-1/2 mt-8 md:mt-0" src="http://localhost:8080/img/Innovacion.png" alt="Dos médicos" />
        </div>
    </section>


    <x-common.footer/>
</div>
