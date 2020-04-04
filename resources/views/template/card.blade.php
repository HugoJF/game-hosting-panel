@php
    $highlight  = $highlight ?? false;
@endphp

<div class="w-1/3 p-4 {{ $class ?? '' }}">
    
    <!-- Card -->
    <div class="flex flex-col text-gray-800 border border-gray-500 justify-between items-center {{ $highlight ? 'shadow-lg' : 'shadow' }}">
        <!-- Card Header -->
        @if(isset($title))
            <div class="self-stretch py-3 border-b border-gray-500 bg-gray-300">
                <h3 class="font-normal text-center text-gray-800">{{ $title }}</h3>
            </div>
        @endif
    
        <!-- Card Body -->
        <div class="flex flex-col items-center p-8">
            <!-- Cost -->
            <div>
                <h4 class="flex items-baseline text-5xl">
                    <span class="mr-1 font-light text-gray-500">R$</span>
                    <span class="font-semibold text-gray-800">{{ $price }}</span>
                </h4>
            </div>
            
            <!-- Features -->
            <ul class="my-8 list-reset text-center text-sm">
                <li>Acesso aos comandos <strong>!ws</strong>, <strong>!gloves</strong>, <strong>!knife</strong>;</li>
                <li><strong>Vaga garantida</strong> em todos os servidores;</li>
                <li><strong>Report prioritário</strong>;</li>
                <li>Tag <strong>[VIP]</strong> no chat e scoreboard.</li>
            </ul>
            
            <!-- CTA -->
            @if($highlight)
                <a href="#" class="trans block shadow-3d-blue-sm border px-10 py-2 text-center text-blue-100 text-3xl font-semibold border-blue-500 bg-blue-500 no-underline hover:bg-blue-600 hover:border-blue-600">
                    Comprar
                </a>
            @else
                <a href="#" class="trans block border px-10 py-2 text-center text-blue-500 text-3xl font-semibold border-blue-500 bg-transparent no-underline hover:bg-blue-600 hover:border-blue-600 hover:text-blue-100">
                    Comprar
                </a>
            @endif
        </div>
    </div>
</div>
