<x-section
    title="Servidores para qualquer hora"
    description="Crie seu próprio servidor em minutos e pague apenas pelo tempo online!"
    theme="blue"
>
    <div class="my-16" style="width: 1000px">
        <div class="grid grid-cols-3 gap-8">
            @foreach (['csgo', 'minecraft', 'cod4'] as $game)
                @include('landing.components.game-card', [
                    'img' => asset("images/$game.png"),
                    'alt' => $game,
                    'specs' => '1800 marks + 1GB RAM',
                    'price' => random_int(20, 130) / 100,
                    'period' => 'por hora'
                ])
            @endforeach
        </div>
    </div>

    <x-cta>
        Criar servidor
    </x-cta>
</x-section>
