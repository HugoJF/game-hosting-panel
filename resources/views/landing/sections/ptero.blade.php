<x-section
    title="O melhor painel de controle"
    description="Pterodactyl é moderno, é completo, é open-source"
    theme="blue"
>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <!-- Left -->
        <div class="flex flex-col justify-around">
            <x-item title="Console em tempo real">
                Controle seu servidor diretamente do console como se estivesse hospedado localmente.
            </x-item>
            <x-item title="Editor de arquivos web">
                Envie e edite arquivos diretamente do painel de controle, sem precisar de FTP.
            </x-item>
            <x-item title="Bancos de dados, automação, etc">
                RBAC, controle pela API, monitor de recursos, autenticação de 2 fatores, acesso SFTP no mesmo painel.
            </x-item>
        </div>

        <!-- Right -->
        <div>
            <img class="rounded shadow" src="https://i.imgur.com/iCIMGRk.png" alt="Painel">
            <div class="flex justify-center">
                <x-carousel-selector count="3" selected="1"></x-carousel-selector>
            </div>
        </div>
    </div>
</x-section>
