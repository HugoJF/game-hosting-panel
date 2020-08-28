<!-- TODO: unused -->
@php
    $parameters = [
        'cpu' => [
            'name' => 'CPU',
            'cost' => 50,
            'unit' => '%',
            'description' => 'por 100% CPU',
            'options' => [
                'cpu-25' => [
                    'label'=> '25%',
                    'value' => 25,
                ],
                'cpu-50' => [
                    'label'=> '50%',
                    'value' => 50,
                ],
                'cpu-75' => [
                    'label'=> '75%',
                    'value' => 75,
                ],
                'cpu-100' => [
                    'label'=> '100%',
                    'value' => 100,
                ],
            ],
        ],
        'memory' => [
            'name' => 'RAM',
            'cost' => 20,
            'unit' => 'GB',
            'description' => 'por GB de RAM',
            'options' => [
                'memory-1000' => [
                    'label'=> '1GB',
                    'value' => 1000,
                ],
                'memory-2000' => [
                    'label'=> '2GB',
                    'value' => 2000,
                ],
                'memory-3000' => [
                    'label'=> '3GB',
                    'value' => 3000,
                ],
                'memory-4000' => [
                    'label'=> '4GB',
                    'value' => 4000,
                ],
                'memory-5000' => [
                    'label'=> '5GB',
                    'value' => 5000,
                ],
                'memory-6000' => [
                    'label'=> '6GB',
                    'value' => 6000,
                ],
            ],
        ],
        'disk' => [
            'name' => 'Disco',
            'cost' => 5,
            'unit' => 'MB',
            'description' => 'por 10GB',
            'options' => [
                'disk-10' => [
                    'label'=> '10GB',
                    'value' => 10000,
                ],
                'disk-20' => [
                    'label'=> '20GB',
                    'value' => 20000,
                ],
                'disk-30' => [
                    'label'=> '30GB',
                    'value' => 30000,
                ],
                'disk-40' => [
                    'label'=> '40GB',
                    'value' => 40000,
                ],
                'disk-50' => [
                    'label'=> '50GB',
                    'value' => 50000,
                ],
            ],
        ],
        'databases' => [
            'name' => 'Databases',
            'cost' => 5,
            'unit' => '',
            'description' => 'por database',
            'options' => [
                'databases-1' => [
                    'label'=> '1',
                    'value' => 1,
                ],
                'databases-2' => [
                    'label'=> '2',
                    'value' => 2,
                ],
                'databases-3' => [
                    'label'=> '3',
                    'value' => 3,
                ],
            ],
        ]
    ];
@endphp

<!-- AlpineJS context -->
<script>
    function billing() {
        return {
            cpu: 25,
            memory: 1000,
            disk: 10000,
            databases: 1,
            period: 'daily',
            onChange: function (a) {
                console.log('changed', this, a);
                axios.post('/api/nodes/location/{{ $location->id }}/cost', {
                    cpu: cpu,
                    memory: this.memory,
                    disk: this.disk,
                    databases: this.databases,
                    period: this.period,
                }).then((response) => {
                    console.log(response.data);
                })
            },
            a(cpu) {
                console.log(this, cpu, disk);
            }
        }
    }
</script>

<div
    x-data="billing()"
    class="flex justify-center"
    x-init="$watch('cpu', () => { console.log(this, disk); })"
    x-iinit="{{ join('; ', array_map(function ($e) {
	            return "\$watch('$e', onChange.bind(this, this))";
            }, ['cpu', 'ram', 'disk', 'databases', 'period'])) }}"
>

    <!-- Form fields -->
    <div class="p-4 w-2/3">
        @foreach ($parameters as $key => $parameter)
            <div class="mb-8">
                <!-- Header -->
                <div class="flex items-stretch bg-green-600 overflow-hidden rounded-t-lg">
                    <!-- Title -->
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        {{ $parameter['name'] }}
                    </div>

                    <!-- Details -->
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white">
                        <div>
                            <small class="font-light text-xl text-green-100">R$ </small>
                            <span class="font-medium">{{ $parameter['cost'] }}</span>
                        </div>
                        <div class="font-normal text-green-200 tracking-tight text-sm">{{ $parameter['description'] }}</div>
                    </div>
                </div>

                <!-- Parameter options -->
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    @foreach($parameter['options'] as $optionKey => $option)
                        <input x-model="{{ $key }}" class="hidden" id="{{ $optionKey }}" name="{{ $key }}" type="radio" value="{{ $option['value'] }}">
                        <label for="{{ $optionKey }}"
                               class="trans flex items-center justify-center w-1/2 py-4 mx-2
                                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                                        hover:bg-white hover:text-gray-900 hover:shadow"
                        >
                            {{ $option['label'] }}
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Cart -->
    <div class="p-4 w-1/3">
        <div class="bg-green-600 rounded-t-lg rounded-b-lg">
            <div class="flex items-center px-6 py-4 mb-1 text-3xl text-gray-100 bg-gray-900 rounded-t-lg shadow-lg">
                Resumo
            </div>
            <div class="p-4 bg-gray-100 border border-t-0 rounded-b-lg">
                <div class="flex flex-col text-xl">
                    @foreach ($parameters as $key => $parameter)
                        <div class="flex justify-between">
                            <p class="font-bold text-gray-700">
                                {{ $parameter['name'] }}:
                                <span class="ml-1 font-normal text-lg">
                                            <span x-text="{{ $key }}"></span>{{ $parameter['unit'] }}
                                        </span>
                            </p>
                            <p class="">R$ 25,00</p>
                        </div>
                    @endforeach

                    <hr class="my-2">

                    <div class="my-2 form-group">
                        <select x-model="period" name="period" class="form-control form-control-lg" required>
                            <option>=== Periodo de pagamento ===</option>
                            <option value="hourly">Por hora</option>
                            <option value="daily">Por dia</option>
                            <option value="weekly">Por semana</option>
                            <option value="monthly">Por mes</option>
                        </select>
                    </div>

                    <hr class="my-2">

                    <div class="flex justify-between text-2xl">
                        <p class="font-bold text-gray-700">
                            TOTAL
                        </p>
                        <p class="font-bold">R$ 75,00</p>
                    </div>

                </div>
                <button
                    class="w-full mt-4 px-6 py-4 bg-green-600 font-normal text-center text-gray-100 text-2xl tracking-wide rounded-lg shadow-md"
                    type="submit"
                >
                    Finalizar
                </button>
            </div>
        </div>
    </div>
</div>
