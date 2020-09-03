<x-section
    title="Como criar seu servidor"
    description="Tenha seu próprio servidor em questão de segundos"
    theme="blue"
>
    <div class="flex justify-between flex-wrap xl:flex-no-wrap">
        <!-- 1 -->
        <x-step
            number="1"
            image="{{ asset('images/select-game.png') }}"
        >
            Selecione o jogo
        </x-step>

        <!-- 2 -->
        <x-step
            number="2"
            image="{{ asset('images/select-parameters.png') }}"
        >
            Escolha uma configuração
        </x-step>

        <!-- 3 -->
        <x-step
            number="3"
            image="{{ asset('images/configure.png') }}"
        >
            Configure
        </x-step>

        <!-- 4 -->
        <x-step
            number="4"
            image="{{ asset('images/online.png') }}"
        >
            Inicie o servidor
        </x-step>
    </div>
</x-section>
