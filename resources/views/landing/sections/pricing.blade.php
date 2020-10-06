<x-section
    title="Hospedagem de servidores para qualquer hora"
    description="Hospede seu próprio servidor em minutos e pague apenas pelo tempo online!"
    theme="blue"
>
    <div class="px-8 grid grid-cols-2 md:grid-cols-3 gap-8 items">
        @include('landing.components.game-card', [
            'game' => 'Minecraft Vanilla',
            'img'           => asset("images/minecraft.png"),
            'alt'           => 'Hospedagem de servidor de Minecraft Vanilla',
            'specs'         => '1GB RAM ~10 slots',
            'hourlyPrice'   => 0.46,
            'dailyPrice'    => 4.77,
        ])
        @include('landing.components.game-card', [
	        'game' => 'Counter-Strike: Global Offensive',
            'img'           => asset("images/csgo.png"),
            'alt'           => 'Hospedagem de servidor de Counter Strike: Global Offensive',
            'specs'         => '10 slots de 128 tick',
            'hourlyPrice'   => 0.63,
            'dailyPrice'    => 6.50,
        ])
        @include('landing.components.game-card', [
            'game' => 'Call of Duty 4: Modern Warfare',
            'img'           => asset("images/cod4.png"),
            'alt'           => 'Hospedagem de servidor de Call of Duty 4 Xtended',
            'specs'         => '12 slots',
            'hourlyPrice'   => 0.21,
            'dailyPrice'    => 2.16,
        ])
    </div>

    <div class="flex justify-center mt-16">
        <x-cta href="{{ route('register') }}">
            Criar servidor
        </x-cta>
    </div>
</x-section>
