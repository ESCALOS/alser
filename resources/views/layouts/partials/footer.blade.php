<footer class="text-white bg-home-primary home-footer">
    <div
        class="flex flex-col flex-wrap items-center justify-around space-x-4 border-gray-100 border-y text-pretty text-md">
        <div class="grid max-w-screen-xl gap-12 px-6 py-10 mx-auto md:grid-cols-3">
            <div class="space-y-8 text-md">
                <img src="{{ asset('storage/images/logo-alser.png') }}" alt="logo">
                <p class="text-gray-300">
                    Alser Cambio es una marca registrada de Alser Cambio Fintech SAC para comprar y vender dólares y
                    cambiar soles y dólares online.
                </p>
                <p class="text-gray-300">
                    Registrada como casa de cambio en la SBS (Número de Resolución: 01413-2019)
                </p>
            </div>
            <div>
                <h3 class="pb-2 mb-4 text-xl font-bold border-b-2 border-purple-600">MAPA DEL SITIO</h3>
                <ul class="space-y-4 text-gray-300 text-md">
                    <li><a wire:navigate href="{{ route('home') }}">Inicio</a></li>
                    <li><a wire:navigate href="{{ route('home.about') }}">Nosotros</a></li>
                    <li><a wire:navigate href="{{ route('home.companies') }}">Empresas</a></li>
                    <li><a wire:navigate href="{{ route('home.exchange-rate') }}">Tipo de Cambio</a></li>
                    <li><a target="_blank" href="{{ route('terms.show') }}">Términos y Condiciones</a></li>
                    <li><a target="_blank" href="{{ route('policy.show') }}">Política de Privacidad</a></li>
                </ul>
            </div>
            <div>
                <h3 class="pb-2 mb-4 text-xl font-bold border-b-2 border-purple-600">CONTACTO</h3>
                <ul class="space-y-4 text-gray-300">
                    <li><i class="fa-regular fa-clock"></i> Lunes a Viernes de 8:00 a.m. a 8:00 p.m. y Sábado de 9:00
                        a.m. a
                        3:00 p.m.</li>
                    <li><i class="fa-solid fa-location-dot"></i> Ca. Mártir Olaya 129. Of.: 1302. Miraflores, Lima.</li>
                    <li><i class="fa-solid fa-phone"></i> (01) 4800648</li>
                    <li><i class="fa-brands fa-whatsapp"></i> 51924901611</li>
                    <li><i class="fa-regular fa-envelope"></i> info@alsercambio.com</li>
                </ul>
            </div>
        </div>
    </div>
    <p class="py-4 text-center">©2024 Todos los derechos reservados | RUC: 20608348329 - ALSER CAMBIO</p>
</footer>
