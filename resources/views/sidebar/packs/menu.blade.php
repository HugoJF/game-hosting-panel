@auth
    @component('components.sidebar-pack', ['id' => 'menu'])
        @slot('title')
            Menu
        @endslot
        <ul class="collapse pl-0 mb-0 flex flex-col text-sm">
            <!-- Home -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('home') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="home"></span>
                    <span class="group-hover:text-gray-400">Home</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#homeHelpModal" data-feather="help-circle"></span>
                </a>
            </li>

            <!-- Servidores -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('servers.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="server"></span>
                    <span class="group-hover:text-gray-400">Servidores</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#ordersHelpModal" data-feather="help-circle"></span>
                </a>
            </li>

            <!-- Transactions -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('transactions.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="credit-card"></span>
                    <span class="group-hover:text-gray-400">Transações</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#tokensHelpModal" data-feather="help-circle"></span>
                </a>
            </li>

            <!-- Usuários -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('orders.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="shopping-cart"></span>
                    <span class="group-hover:text-gray-400">Pedidos</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#usersHelpModal" data-feather="help-circle"></span>
                </a>
            </li>

            <!-- Afiliados -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('coupons.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="gift"></span>
                    <span class="group-hover:text-gray-400">Coupons</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#affiliatesHelpModal" data-feather="help-circle"></span>
                </a>
            </li>

            <!-- API -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('api-keys.index') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="key"></span>
                    <span class="group-hover:text-gray-400">API Keys</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#productsHelpModal" data-feather="help-circle"></span>
                </a>
            </li>

            <!-- Cupons -->
            <li class="flex justify-between my-2 ml-3">
                <a href="{{ route('admins.dashboard') }}" class="flex items-center text-gray-500 no-underline text-base group">
                    <span class="mr-1 text-gray-400 group-hover:text-white" data-feather="briefcase"></span>
                    <span class="group-hover:text-gray-400">Administrative</span>
                </a>
                <a class="group no-underline" href="#">
                    <span class="text-gray-400 group-hover:text-white" data-toggle="modal" data-target="#couponsHelpModal" data-feather="help-circle"></span>
                </a>
            </li>
        </ul>
    @endcomponent
@endauth
