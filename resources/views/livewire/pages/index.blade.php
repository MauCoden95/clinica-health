<div>
    <x-common.header />



    <section class="relative w-full min-h-[450px] z-30 py-5 md:py-0 px-8 md:px-14 flex flex-col md:flex-row items-center justify-center">

        <div class="w-full md:w-2/4 mb-8 md:mb-0">
            <h2 class="text-2xl md:text-4xl mb-4 md:mb-6 text-center md:text-left">
                Cuidamos tu salud, <span class="font-bold">transformamos tu vida.</span>
            </h2>
            <p class="text-sm md:text-base text-center md:text-left">
                En nuestra clínica, tu salud es nuestra prioridad. Ofrecemos atención médica integral con profesionales dedicados y tecnología de vanguardia. Nos comprometemos a brindarte un cuidado personalizado y de calidad, asegurando tu bienestar en cada paso del camino.
            </p>
        </div>

        <div class="w-full md:w-2/5 flex justify-center">
            <img src="http://localhost:8000/img/Banner1.png" alt="Dos médicos"
                class="max-w-full h-auto object-contain rounded-lg" />
        </div>

    </section>



    <section class="relative w-full h-auto z-30 py-12 md:py-20 px-8 md:px-14 flex flex-col md:flex-row flex-wrap gap-6 items-center justify-center">


        <div class="w-full sm:w-1/2 md:w-1/4 bg-gradient-to-br from-red-600 to-red-700 p-8 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 text-white text-2xl mr-3">
                    <i class="fas fa-home"></i>
                </div>
                <h4 class="font-bold text-xl text-white">Atención a Domicilio</h4>
            </div>
            <p class="text-white text-sm md:text-base leading-relaxed">
                Brindamos servicios médicos en la comodidad de tu hogar.
            </p>
        </div>


        <div class="w-full sm:w-1/2 md:w-1/4 bg-gradient-to-br from-red-700 to-red-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 text-white text-2xl mr-3">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h4 class="font-bold text-xl text-white">Consultas Especializadas</h4>
            </div>
            <p class="text-white text-sm md:text-base leading-relaxed">
                Contamos con un equipo de especialistas en diversas áreas de la salud.
            </p>
        </div>


        <div class="w-full sm:w-1/2 md:w-1/4 bg-gradient-to-br from-red-600 to-red-700 p-8 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 text-white text-2xl mr-3">
                    <i class="fas fa-microscope"></i>
                </div>
                <h4 class="font-bold text-xl text-white">Exámenes y Diagnósticos</h4>
            </div>
            <p class="text-white text-sm md:text-base leading-relaxed">
                Ofrecemos una amplia gama de pruebas diagnósticas.
            </p>
        </div>


        <div class="w-full sm:w-1/2 md:w-1/4 bg-gradient-to-br from-red-700 to-red-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 text-white text-2xl mr-3">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h4 class="font-bold text-xl text-white">Programas de Prevención</h4>
            </div>
            <p class="text-white text-sm md:text-base leading-relaxed">
                Implementamos programas de bienestar para promover estilos de vida saludables.
            </p>
        </div>

    </section>





    <section class="w-full min-h-[450px] z-30 px-8 md:px-14 mb-16 sm:mb-24 md:my-32">
        <h3 class="nanum text-3xl sm:text-4xl md:text-5xl text-center font-bold text-gray-800 my-8 sm:my-10 md:my-12">
            Nuestros servicios
        </h3>

        
        <div class="swiper">
            <div class="w-5/6 swiper-wrapper px-2 mb-10">
                @foreach($services as $service)
                <div
                    class="swiper-slide card_services mt-12 bg-white rounded-xl shadow-md transform hover:-translate-y-2 transition duration-300 ease-out p-4">

                   
                    <figure class="overflow-hidden rounded-t-xl">
                        <img src="{{ $service['image'] }}" alt="{{ $service['atl'] }}"
                            class="w-full h-48 object-cover transform transition duration-500 ease-out" />
                    </figure>

                    <div class="card-body text-center p-4">
                        <h2 class="card-title text-lg sm:text-xl md:text-2xl font-semibold text-gray-800 mb-3">
                            {{ $service['specialty'] }}
                        </h2>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                            {{ $service['desc'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>
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

        <div class="flex gap-8 flex-col md:flex-row items-center justify-around">
            <div class="w-full md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-xl sm:text-2xl font-bold mb-4">Innovación al Servicio de tu Salud</h2>
                <p class="text-base sm:text-lg my-4">
                    Nuestra clínica incorpora tecnología y enfoques modernos para garantizar una atención médica avanzada, cómoda y eficiente.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-7">
                    <ul>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Consulta con nuestros especialistas desde cualquier lugar.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Accede a tu información médica de forma rápida y segura.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Tecnología de última generación para diagnósticos precisos.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Seguimiento continuo de pacientes crónicos desde sus hogares.</span>
                        </li>
                    </ul>

                    <ul>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Gestiona tus citas y resultados de manera fácil y rápida.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Tratamientos modernos y eficaces para distintas patologías.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Protocolos de atención diseñados según las necesidades individuales.</span>
                        </li>
                        <li class="flex items-center my-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">Programas preventivos basados en datos y análisis predictivo.</span>
                        </li>
                    </ul>
                </div>
            </div>
            <img class="w-full md:w-1/3 mt-8 md:mt-0 shadow-lg" src="http://localhost:8000/img/Innovacion.png" alt="Dos médicos" />
        </div>
    </section>


    <x-common.footer />
</div>