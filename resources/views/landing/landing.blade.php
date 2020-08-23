@extends('layouts.landing')

@section('content')
    <div class="flex flex-col items-center justify-center w-full bg-blue-dark min-h-screen">
        <h1 class="text-5xl text-center text-white font-bold">Servidores para qualquer hora</h1>
        <h2 class="text-lg text-blue-light tracking-tighter">Crie seu próprio servidor em minutos e pague apenas pelo tempo online!</h2>

        <div class="my-16" style="width: 1000px">
            <div class="grid grid-cols-3 gap-8">
                @foreach (['csgo', 'minecraft', 'cod4'] as $game)
                    @php
                        $img = asset("images/$game.png");
                        $alt = $game;
                        $specs = "1800 marks + 1GB RAM";
                        $price = "0.77";
                        $period = "por hora";
                    @endphp

                    @include('landing.components.game-card', compact('img', 'alt', 'specs', 'price', 'period'))
                @endforeach
            </div>
        </div>

        <x-cta>
            Criar servidor
        </x-cta>
    </div>
@endsection
