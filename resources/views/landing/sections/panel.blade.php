<x-section
    title="Painel administrativo poderoso"
    description="PHP 7, Laravel, NodeJS e Docker"
    theme="white"
>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <!-- Left -->
        <div>
            <img class="rounded shadow" src="https://i.imgur.com/2FNlzor.png" alt="Painel">
            <div class="flex justify-center">
                <x-carousel-selector count="3" selected="1"></x-carousel-selector>
            </div>
        </div>

        <!-- Right -->
        <div class="flex flex-col justify-around">
            <x-item title="Criação instantânea de servidores">
                Todos os nossos servidores são criados em menos de 60 segundos.
            </x-item>
            <x-item title="Controle tudo pela nossa API">
                Crie, atualize, inicie e remova servidores diretamente da nossa API.
            </x-item>
            <x-item title="Administração simplificada">
                Crie e controle quantos servidores sua demanda exigir com facidade.
            </x-item>
        </div>
    </div>
</x-section>
