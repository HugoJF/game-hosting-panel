<div class="w-full flex justify-center px-8 pt-8 text-white">
    <div class="container mx-auto flex justify-between items-center flex-wrap">
        <!-- Menu -->
        <div class="mx-auto md:mx-0">
            <ul class="flex justify-around md:justify-start space-x-16">
                <li class="transition-colors duration-150 text-base text-white hover:text-super-white font-medium tracking-wide hover:underline cursor-pointer">
                    <a href="https://maxihost.com">Datacenter</a>
                </li>
                <li class="transition-colors duration-150 text-base text-white hover:text-super-white font-medium tracking-wide hover:underline cursor-pointer">
                    <a href="https://host.denerdtv.com/docs/1.0/servidores/ddos">Documentação</a>
                </li>
                <li class="transition-colors duration-150 text-base text-white hover:text-super-white font-medium tracking-wide hover:underline cursor-pointer">
                    <a href="https://denerdtv.com/discord">Contato</a>
                </li>
            </ul>
        </div>

        <!-- Auth -->
        <div class="mx-auto md:mx-0 mt-4 md:mt-0">
            <a class="inline-block transition-colors duration-150 py-3 px-8 text-base text-white hover:text-super-white font-normal border border-blue-light hover:border-white rounded" href="{{ route('login') }}">
                Painel
            </a>
            <a class="transition-colors transition-shadow duration-150 inline-block py-3 px-8 ml-8 bg-blue-primary text-base text-white hover:text-super-white font-normal rounded shadow hover:shadow-lg" href="{{ route('register') }}">
                Registrar
            </a>
        </div>
    </div>
</div>
