<div data-theme="light">
    <x-common.header/>

    <section class="relative w-full min-h-[450px] z-30 px-14 flex items-center justify-center">
        <div class="w-2/4">
            <h2 class="text-4xl mb-6">Cuidamos tu salud, <span class="font-bold">transformamos tu vida.</span></h2>
            <p class="">
                En nuestra clínica, tu salud es nuestra prioridad. Ofrecemos atención médica integral con profesionales dedicados y tecnología de vanguardia. Nos comprometemos a brindarte un cuidado personalizado y de calidad, asegurando tu bienestar en cada paso del camino.
            </p>
        </div>
        <img class="w-2/5" src="http://localhost:8000/img/Banner1.png" alt="Dos médicos" />
    </section>


    <section class="relative w-full h-auto z-30 py-12 px-14 flex gap-6 items-center justify-center">
        <div class="w-1/4 h-48 bg-red-500 p-4 rounded-lg">
            <h4 class="font-bold">
                <i class="fas fa-home"></i>
                Atención a Domicilio
            </h4>
            <p class="my-7">
                Brindamos servicios médicos en la comodidad de tu hogar
            </p>
        </div>

        <div class="w-1/4 h-48 bg-red-600 p-4 rounded-lg">
            <h4 class="font-bold">
                <i class="fas fa-home"></i>
                Consultas Especializadas
            </h4>
            <p class="my-7">
                Contamos con un equipo de especialistas en diversas áreas de la salud
            </p>
        </div>

        <div class="w-1/4 h-48 bg-red-500 p-4 rounded-lg">
            <h4 class="font-bold">
                <i class="fas fa-home"></i>
                Exámenes y Diagnósticos
            </h4>
            <p class="my-7">
                Ofrecemos una amplia gama de pruebas diagnósticas
            </p>
        </div>

        <div class="w-1/4 h-48 bg-red-600 p-4 rounded-lg">
            <h4 class="font-bold">
                <i class="fas fa-home"></i>
                Programas de Prevención
            </h4>
            <p class="my-7">
                Implementamos programas de bienestar para promover estilos de vida saludables
            </p>
        </div>
    </section>

    <section class="w-full min-h-[450px] z-30 px-14 mb-32">
        <h3 class="nanum text-5xl text-center my-12">Nuestros servicios</h3>

        <div class="grid gap-7 grid-cols-3">
            @foreach($services as $service)
                <div class="card_services bg-base-100 w-full p-3 rounded-md mt-3 hover:-translate-y-4 duration-300">
                    <figure>
                        <img src="{{ $service['image'] }}" alt="{{ $service['atl'] }}" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title text-center my-4 text-xl font-bold">{{ $service['specialty'] }}</h2>
                        <p class="p-3">{{ $service['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <section class="relative w-full h-auto px-28 my-20">
        <h2 class="text-xl">
            
        </h2>
        <blockquote class="mt-4">
            <p>
                <span class="font-bold">En nuestra clínica, estamos comprometidos con brindar una atención médica de vanguardia</span>, siempre centrada en las necesidades de nuestros pacientes. Creemos en la importancia de la innovación tecnológica y el trato humano para ofrecer un cuidado integral y personalizado. Nuestro equipo médico trabaja incansablemente para garantizar el bienestar de cada persona que confía en nosotros, asegurando que reciban el mejor tratamiento en un ambiente cálido y profesional.
            </p>
            <cite class="block text-right">Carlos - Director General</cite>
        </blockquote>
    </section>



    <section class="w-full min-h-[450px] z-30 px-14 mb-32">
        <h3 class="nanum text-5xl text-center my-12">Innovación</h3>

        <div class="flex items-center justify-between">
            <div class="w-2/4">
                <h2 class="text-2xl font-bold">Innovación al Servicio de tu Salud</h2>
                <p class="text-xl my-5">
                    Nuestra clínica incorpora tecnología y enfoques modernos para garantizar una atención médica avanzada, cómoda y eficiente.
                </p>
                <div class="grid grid-cols-2 gap-7">
                        <ul>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Consulta con nuestros especialistas desde cualquier lugar.</span>
                            </li>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Accede a tu información médica de forma rápida y segura.</span>
                            </li>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Tecnología de última generación para diagnósticos precisos.</span>
                            </li>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Seguimiento continuo de pacientes crónicos desde sus hogares.</span>
                            </li>
                        </ul>
                  
                        <ul>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Gestiona tus citas y resultados de manera fácil y rápida.</span>
                            </li>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Tratamientos modernos y eficaces para distintas patologías.</span>
                            </li>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Protocolos de atención diseñados según las necesidades individuales.</span>
                            </li>
                            <li class="flex items-center my-3">
                                <svg class="w-8 h-8 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm">Programas preventivos basados en datos y análisis predictivo.</span>
                            </li>
                        </ul>
                    </div>

            </div>
            <img class="w-2/4" src="http://localhost:8000/img/Innovacion.png" alt="Dos médicos" />
        </div>
    </section>


    <footer class="footer bg-gray-300 text-base-content p-10">
    <aside>
        <img class="w-32" src="http://localhost:8000/img/Logo.png"/>
        <p class="text-black">
            Clínica Health
        <br />
            Cuidando tu salud desde 2000
        </p>
    </aside>
    <nav>
        <h6 class="footer-title text-black">Servicios</h6>
        <a class="link link-hover text-black">Consultas médicas</a>
        <a class="link link-hover text-black">Exámenes de laboratorio</a>
        <a class="link link-hover text-black">Imagenología</a>
        <a class="link link-hover text-black">Urgencias</a>
    </nav>
    <nav>
        <h6 class="footer-title text-black">Nosotros</h6>
        <a class="link link-hover text-black">Sobre nosotros</a>
        <a class="link link-hover text-black">Contacto</a>
        <a class="link link-hover text-black">Trabaja con nosotros</a>
        <a class="link link-hover text-black">Noticias</a>
    </nav>
    <nav>
        <h6 class="footer-title text-black">Legal</h6>
        <a class="link link-hover text-black">Términos de uso</a>
        <a class="link link-hover text-black">Política de privacidad</a>
        <a class="link link-hover text-black">Política de cookies</a>
    </nav>
    </footer>
</div>
