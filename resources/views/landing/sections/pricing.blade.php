<x-section
    title="Servidores para qualquer hora"
    description="Crie seu próprio servidor em minutos e pague apenas pelo tempo online!"
    theme="blue"
>
    <div class="px-8 grid grid-cols-2 md:grid-cols-3 gap-8 items">
        @foreach (['csgo', 'minecraft', 'cod4'] as $game)
            @include('landing.components.game-card', [
                'img' => asset("images/$game.png"),
                'alt' => $game,
                'specs' => '1800 marks + 1GB RAM + 20GB SSD',
                'price' => random_int(20, 130) / 100,
                'period' => 'por hora'
            ])
        @endforeach
    </div>

    <div class="flex justify-center mt-16">
        <x-cta href="{{ route('login') }}">
            Criar servidor
        </x-cta>
    </div>
</x-section>
