@component('components.sidebar-pack', ['id' => 'links'])
    @slot('title')
        Links rápidos
    @endslot
    <ul class="pl-0 mb-0 flex flex-col text-sm">
        <li class="my-2 ml-3 group">
            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/como-comprar-vip-com-skins/">
                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                Como comprar VIP com skins <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="my-2 ml-3 group">
            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/como-comprar-vip-com-mercadopago/">
                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                Como comprar VIP com MercadoPago
            </a>
        </li>
        <li class="my-2 ml-3 group">
            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/como-comprar-vip-com-paypal/">
                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                Como comprar VIP com PayPal
            </a>
        </li>
        <li class="my-2 ml-3 group">
            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/faq/">
                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                Perguntas frequentes
            </a>
        </li>
        <li class="my-2 ml-3 group">
            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="https://denerdtv.com/discord">
                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                Suporte
            </a>
        </li>
        <li class="my-2 ml-3 group">
            <a class="flex items-center text-gray-500 no-underline text-sm group-hover:text-gray-400" href="#">
                <span class="flex-shrink-0 mr-1 w-4 h-4" data-feather="chevron-right"></span>
                Termos de uso
            </a>
        </li>
    </ul>
@endcomponent
