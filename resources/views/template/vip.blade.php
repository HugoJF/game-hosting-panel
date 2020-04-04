@extends('layouts.app')

@section('content')


    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Localizações</h1>

    <!-- Card deck -->
    <div class="location-deck">
        <a class="location">
            <div class="flag">@include('flags.us')</div>
            <div class="info">
                <h2 class="country">EUA</h2>
                <h4 class="name">Level3 - MIA2</h4>
            </div>
        </a>
        <a class="location">
            <div class="flag">@include('flags.brazil')</div>
            <div class="info">
                <h2 class="country">Brasil</h2>
                <h4 class="name">Maxihost - MH1</h4>
            </div>
        </a>
        <a class="location">
            <div class="flag">@include('flags.canada')</div>
            <div class="info">
                <h2 class="country">Canadá</h2>
                <h4 class="name">OVH - RBX1</h4>
            </div>
        </a>
    </div>

    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Preços</h1>

    <!-- Card deck -->
    <div class="flex flex-wrap p-8">
        @include('template.card', [
            'title' => '14 dias de VIP',
            'class' => '',
            'price' => '4,00'
        ])
        @include('template.card', [
            'title' => '30 dias de VIP',
            'class' => 'scale-110',
            'highlight' => true,
            'price' => '8,00'
        ])
        @include('template.card', [
            'title' => '60 dias de VIP',
            'class' => '',
            'price' => '16,00'
        ])
    </div>

    <!-- Column steps -->
    <div class="py-4 px-12 flex">
        <div class="w-1/3 flex items-center justify-center">
            <div class="h-4 -m-1 z-0 flex-grow bg-green-400 rounded-l-full"></div>
            <div class="flex h-12 w-12 z-10 justify-center items-center bg-white bg-gray-100 border-4 border-gray-800 rounded-full">
                <span class="text-gray-800 text-2xl font-mono font-bold">1</span>
            </div>
            <div class="h-4 -m-1 z-0 flex-grow bg-green-400"></div>
        </div>
        <div class="w-1/3 flex items-center justify-center">
            <div class="h-4 -m-1 z-0 flex-grow bg-gray-400"></div>
            <div class="flex h-12 w-12 z-10 justify-center items-center bg-white bg-gray-100 border-4 border-gray-800 rounded-full">
                <span class="text-gray-800 text-2xl font-mono font-bold">2</span>
            </div>
            <div class="h-4 -m-1 z-0 flex-grow bg-gray-400"></div>
        </div>
        <div class="w-1/3 flex items-center justify-center">
            <div class="h-4 -m-1 z-0 flex-grow bg-gray-400"></div>
            <div class="flex h-12 w-12 z-10 justify-center items-center bg-white bg-gray-100 border-4 border-gray-800 rounded-full">
                <span class="text-gray-800 text-2xl font-mono font-bold">3</span>
            </div>
            <div class="h-4 -m-1 z-0 flex-grow bg-gray-400 rounded-r-full"></div>
        </div>
    </div>

    <!-- Absolute steps -->
    <div class="py-4 px-12 flex">
        <div class="relative flex h-4 w-full">
            <div class="trans absolute top-0 left-0 bottom-0 right-0 bg-gray-400 overflow-hidden rounded-full">
                <div class="trans h-full bg-green-500 w-32"></div>
            </div>
            <div class="w-1/3 flex items-center justify-center">
                <div class="flex h-12 w-12 z-10 justify-center items-center bg-white bg-gray-100 border-4 border-gray-800 rounded-full">
                    <span class="text-gray-800 text-2xl font-mono font-bold">1</span>
                </div>
            </div>
            <div class="w-1/3 flex items-center justify-center">
                <div class="flex h-12 w-12 z-10 justify-center items-center bg-white bg-gray-100 border-4 border-gray-800 rounded-full">
                    <span class="text-gray-800 text-2xl font-mono font-bold">2</span>
                </div>
            </div>
            <div class="w-1/3 flex items-center justify-center">
                <div class="flex h-12 w-12 z-10 justify-center items-center bg-white bg-gray-100 border-4 border-gray-800 rounded-full">
                    <span class="text-gray-800 text-2xl font-mono font-bold">3</span>
                </div>
            </div>
        </div>
    </div>

    <!-- My step -->
    <div class="my-2 py-4 px-12 flex">
        <div class="relative flex justify-around h-1 w-full">
            <div class="trans absolute top-0 left-0 bottom-0 right-0 bg-gray-600 shadow overflow-hidden rounded-full">
                <div style="width: 33%" class="trans h-full bg-green"></div>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex flex-shrink-0 h-10 shadow w-10 z-10 justify-center items-center bg-white bg-gray-100 border-2 border-green-500 rounded-full">
                    <span class="text-gray-800 text-2xl font-mono font-bold">1</span>
                </div>
                <div class="relative flex justify-center left-0 top-0 right-0">
                    <p class="text-center absolute h-8 whitespace-no-wrap text-gray-800">Gerar o pedido</p>
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex flex-shrink-0 h-10 shadow w-10 z-10 justify-center items-center bg-white bg-gray-100 border-2 border-gray-600 rounded-full">
                    <span class="text-gray-800 text-2xl font-mono font-bold">2</span>
                </div>
                <div class="relative flex justify-center left-0 top-0 right-0">
                    <p class="text-center absolute h-8 whitespace-no-wrap text-gray-800">Pagar o pedido</p>
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <div class="flex flex-shrink-0 h-10 shadow w-10 z-10 justify-center items-center bg-white bg-gray-100 border-2 border-gray-600 rounded-full">
                    <span class="text-gray-800 text-2xl font-mono font-bold">2</span>
                </div>
                <div class="relative flex justify-center left-0 top-0 right-0">
                    <p class="text-center absolute h-8 whitespace-no-wrap text-gray-800">Esperar sincronização</p>
                </div>
            </div>
        </div>
    </div>

    <div class="my-2 py-4 px-12 flex">
        <table class="table-fixed w-full text-gray-800">
            <tbody>
            <tr class="border-t border-b border-gray-400">
                <td class="p-2 text-lg text-gray-800 font-normal">Duração:</td>
                <td class="px-2">
                    @include('template.tag', [
                        'text' => '30 dias',
                        'color' => 'green',
                    ])
                </td>
            </tr>
            <tr class="border-t border-b border-gray-400">
                <td class="p-2 text-lg text-gray-800 font-normal">Inicia em:</td>
                <td class="px-2">
                    @include('template.tag', [
                        'text' => 'Sun Apr 21 2019 11:21:42 GMT-0400',
                        'color' => 'green',
                    ])
                </td>
            </tr>
            <tr class="border-t border-b border-gray-400">
                <td class="p-2 text-lg text-gray-800 font-normal">Finaliza em:</td>
                <td class="px-2">
                    @include('template.tag', [
                        'text' => 'Sun Apr 21 2019 11:21:42 GMT-0400',
                        'color' => 'green',
                    ])
                </td>
            </tr>
            <tr class="border-t border-b border-gray-400">
                <td class="p-2 text-lg text-gray-800 font-normal">Valor total:</td>
                <td class="px-2">
                    @include('template.tag', [
                        'text' => 'R$ 8,00',
                        'color' => 'green',
                    ])
                </td>
            </tr>
            <tr class="border-t border-b border-gray-400">
                <td class="p-2 text-lg text-gray-800 font-normal">Valor pago:</td>
                <td class="px-2">
                    @include('template.tag', [
                        'text' => 'R$ 0,00',
                        'color' => 'red',
                    ])
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <h1 class="mt-8 font-thin text-center text-5xl text-gray-800 tracking-widerr">Meus pedidos</h1>

    <div class="py-4 px-12">
        <table class="w-full text-gray-800">
            <thead class="bg-gray-200 border-t border-b border-gray-400">
            <tr>
                <th class="py-2 px-3">ID do pedido</th>
                <th class="py-2 px-3">Usuário</th>
                <th class="py-2 px-3">Duração</th>
                <th class="py-2 px-3">Criado em</th>
                <th class="py-2 px-3">
                    <span>Estado</span>
                    <a href="#"><span class="text-gray-700" data-feather="help-circle"></span></a>
                </th>
                <th class="py-2 px-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 px-3 font-mono font-medium">#3c377c9e</td>
                <td class="py-2 px-3">
                    <a href="#" class="text-blue-500 font-semibold">Itachi</a>
                    <a class="group" href="#">
                        <span class="ml-2 h-4 w-4 text-gray-800 group-hover:text-gray-900" data-feather="zoom-in"></span>
                    </a>
                </td>
                <td class="py-2 px-3">30 dias</td>
                <td class="py-2 px-3">
                    29 <span class="text-gray-800 font-400 text-sm">minutos atrás</span>
                </td>
                <td class="py-2 px-3">
                    @include('template.tag', [
                        'text' => 'Cancelado',
                        'color' => 'red',
                    ])
                </td>
                <td class="py-2 px-3">
                    <div class="flex">
                        <a class="px-2 py-1 bg-gray-100 border-t border-l border-gray-500 shadow-3d-white-sm font-medium text-sm">
                            <div class="flex w-full h-full justify-center items-center"><span class="m-0 p-0 h-4 w-4 text-gray-700" data-feather="refresh-cw"></span></div>
                        </a>
                        <a class="inline-block px-3 py-1 bg-blue-500 shadow-3d-blue-sm font-medium text-sm text-blue-100 text">Detalhes</a>
                        <a class="inline-block px-3 py-1 bg-red-500shadow-3d-red-sm font-medium text-sm text-red-100 text">Deletar</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


    <h1 class="mt-8 font-thin text-center text-5xl text-gray-800 tracking-wider">Minhas ativações</h1>

    <div class="py-4 px-12">
        <table class="w-full text-gray-800">
            <thead class="bg-gray-200 border-t border-b border-gray-400">
            <tr>
                <th class="py-2 px-3">ID do pedido</th>
                <th class="py-2 px-3">Usuário</th>
                <th class="py-2 px-3">Total</th>
                <th class="py-2 px-3">Tempo restante</th>
                <th class="py-2 px-3">
                    <span>Estado</span>
                    <a href="#"><span class="text-gray-700" data-feather="help-circle"></span></a>
                </th>
                <th class="py-2 px-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 px-3 font-mono font-medium">#3c377c9e</td>
                <td class="py-2 px-3">
                    <a href="#" class="text-blue-500 font-semibold">Itachi</a>
                    <a class="group" href="#">
                        <span class="h-4 w-4 ml-2 text-gray-800 group-hover:text-gray-800" data-feather="edit"></span>
                    </a>
                </td>
                <td class="py-2 px-3">
                    30 <span class="text-gray-800 font-400 text-sm">dias</span>
                </td>
                <td class="py-2 px-3">
                    22 <span class="text-gray-800 font-400 text-sm">dias</span>
                </td>
                <td class="py-2 px-3">
                    @include('template.tag', [
                        'text' => 'Válido',
                        'color' => 'green',
                    ])
                </td>
                <td class="py-2 px-3">
                    <div class="flex">
                        <a class="px-2 py-1 bg-gray-100 border-t border-l border-gray-500 shadow-3d-white-sm font-medium text-sm">
                            <div class="flex w-full h-full justify-center items-center"><span class="m-0 p-0 h-4 w-4 text-gray-700" data-feather="edit"></span></div>
                        </a>
                        <a class="inline-block px-3 py-1 bg-blue-500 shadow-3d-blue-sm font-medium text-sm text-blue-100 text">Detalhes</a>
                        <a class="inline-block px-3 py-1 bg-red-500shadow-3d-red-sm font-medium text-sm text-red-100 text">Desativar</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <h1 class="mt-8 font-thin text-center text-5xl text-gray-800 tracking-wider">Meus tokens</h1>

    <div class="py-4 px-12">
        <table class="w-full text-gray-800">
            <thead class="bg-gray-200 border-t border-b border-gray-400">
            <tr>
                <th class="py-2 px-3">Token</th>
                <th class="py-2 px-3">Dono</th>
                <th class="py-2 px-3">Usuário</th>
                <th class="py-2 px-3">Duração</th>
                <th class="py-2 px-3">Tempo restante</th>
                <th class="py-2 px-3">
                    <span>Estado</span>
                    <a href="#"><span class="text-gray-700" data-feather="help-circle"></span></a>
                </th>
                <th class="py-2 px-3">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2 px-3 font-mono font-medium">#3c377c9e</td>
                <td class="py-2 px-3">
                    <a href="#" class="text-blue-500 font-semibold">Itachi</a>
                    <a class="group" href="#">
                        <span class="h-4 w-4 ml-2 text-gray-800 group-hover:text-gray-800" data-feather="zoom-in"></span>
                    </a>
                </td>
                <td class="py-2 px-3">
                    <a href="#" class="text-blue-500 font-semibold">de_nerd</a>
                    <a class="group" href="#">
                        <span class="h-4 w-4 ml-2 text-gray-800 group-hover:text-gray-800" data-feather="zoom-in"></span>
                    </a>
                </td>
                <td class="py-2 px-3">
                    30 <span class="text-gray-800 font-400 text-sm">dias</span>
                </td>
                <td class="py-2 px-3">
                    22 <span class="text-gray-800 font-400 text-sm">dias</span>
                </td>
                <td class="py-2 px-3">
                    @include('template.tag', [
                        'text' => 'Usado',
                        'color' => 'blue',
                    ])
                </td>
                <td class="py-2 px-3">
                    <div class="flex">
                        <a class="px-2 py-1 bg-gray-100 border-t border-l border-gray-500 shadow-3d-white-sm font-medium text-sm">
                            <div class="flex w-full h-full justify-center items-center"><span class="m-0 p-0 h-4 w-4 text-gray-700" data-feather="edit"></span></div>
                        </a>
                        <a class="inline-block px-3 py-1 bg-blue-500 shadow-3d-blue-sm font-medium text-sm text-blue-100 text">Copiar URL</a>
                        <a class="inline-block px-3 py-1 bg-red-500shadow-3d-red-sm font-medium text-sm text-red-100 text">Desativar</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
