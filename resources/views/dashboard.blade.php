@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('cards.servers')
    <div class="flex justify-center">
        <div class="p-4 w-2/3">
            <div class="mt-8">
                <div class="flex items-stretch bg-green-600 overflow-hidden rounded-t-lg">
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        CPU
                    </div>
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white ">
                        <div>
                            <small class="font-light text-xl text-green-100">R$ </small>
                            <span class="font-medium">50</span>
                        </div>
                        <div class="font-normal text-green-200 tracking-tight text-sm">por 100% CPU</div>
                    </div>
                </div>
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    <!-- CPU 25% -->
                    <input class="hidden" id="cpu-25" name="cpu" type="radio" value="25">
                    <label for="cpu-25" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        25%
                    </label>

                    <!-- CPU 50% -->
                    <input class="hidden" id="cpu-50" name="cpu" type="radio" value="50">
                    <label for="cpu-50" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        50%
                    </label>

                    <!-- CPU 75% -->
                    <input class="hidden" id="cpu-75" name="cpu" type="radio" value="75">
                    <label for="cpu-75" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        75%
                    </label>

                    <!-- CPU 100% -->
                    <input class="hidden" id="cpu-100" name="cpu" type="radio" value="100">
                    <label for="cpu-100" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        100%
                    </label>
                </div>
            </div>
            <div class="mt-8">
                <div class="flex items-stretch bg-red-600 overflow-hidden rounded-t-lg">
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        RAM
                    </div>
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white ">
                        <div>
                            <small class="font-light text-xl text-red-100">R$ </small>
                            <span class="font-medium">20</span>
                        </div>
                        <div class="font-normal text-red-200 tracking-tight text-sm">por 1GB</div>
                    </div>
                </div>
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    <!-- RAM 1GB -->
                    <input class="hidden" id="ram-1" name="ram" type="radio" value="1">
                    <label for="ram-1" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        1GB
                    </label>

                    <!-- RAM 2GB -->
                    <input class="hidden" id="ram-2" name="ram" type="radio" value="100">
                    <label for="ram-2" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        2GB
                    </label>

                    <!-- RAM 3GB -->
                    <input class="hidden" id="ram-3" name="ram" type="radio" value="100">
                    <label for="ram-3" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        3GB
                    </label>

                    <!-- RAM 4GB -->
                    <input class="hidden" id="ram-4" name="ram" type="radio" value="100">
                    <label for="ram-4" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        4GB
                    </label>

                    <!-- RAM 5GB -->
                    <input class="hidden" id="ram-5" name="ram" type="radio" value="100">
                    <label for="ram-5" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        5GB
                    </label>

                    <!-- RAM 6GB -->
                    <input class="hidden" id="ram-6" name="ram" type="radio" value="100">
                    <label for="ram-6" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        6GB
                    </label>
                </div>
            </div>
            <div class="mt-8">
                <div class="flex items-stretch bg-blue-600 overflow-hidden rounded-t-lg">
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        SSD
                    </div>
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white ">
                        <div>
                            <small class="font-light text-xl text-blue-100">R$ </small>
                            <span class="font-medium">5</span>
                        </div>
                        <div class="font-normal text-blue-200 tracking-tight text-sm">por 10GB</div>
                    </div>
                </div>
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    <!-- Storage 10GB -->
                    <input class="hidden" id="storage-10000" name="storage" type="radio" value="10000">
                    <label for="storage-10000" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        10GB
                    </label>

                    <!-- Storage 20GB -->
                    <input class="hidden" id="storage-20000" name="storage" type="radio" value="20000">
                    <label for="storage-20000" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        20GB
                    </label>

                    <!-- Storage 30GB -->
                    <input class="hidden" id="storage-30000" name="storage" type="radio" value="30000">
                    <label for="storage-30000" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        30GB
                    </label>

                    <!-- Storage 40GB -->
                    <input class="hidden" id="storage-40000" name="storage" type="radio" value="40000">
                    <label for="storage-40000" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        40GB
                    </label>

                    <!-- Storage 50GB -->
                    <input class="hidden" id="storage-50000" name="storage" type="radio" value="50000">
                    <label for="storage-50000" class="
                        trans flex items-center justify-center w-1/4 py-4 mx-2
                        text-2xl text-gray-800 border rounded-lg cursor-pointer select-none
                        checked:bg-gray-900 checked:text-gray-100 checked:shadow-md checked:font-medium checked:cursor-default
                        hover:bg-white hover:text-gray-900 hover:shadow">
                        50GB
                    </label>
                </div>
            </div>
        </div>
        <div class="p-4 w-1/3">
            <div class="mt-8">
                <div class="bg-green-600 rounded-t-lg rounded-b-lg">
                    <div class="flex items-center px-6 py-4 mb-1 text-3xl text-gray-100 bg-gray-900 rounded-t-lg shadow-lg">
                        Resumo
                    </div>
                    <div class="p-4 bg-gray-100 border border-t-0 rounded-b-lg">
                        <div class="flex flex-col text-xl">
                            <div class="flex justify-between">
                                <p class="font-bold text-gray-700">
                                    CPU:
                                    <span class="ml-1 font-normal text-lg">50%</span>
                                </p>
                                <p class="">R$ 25,00</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="font-bold text-gray-700">
                                    RAM:
                                    <span class="ml-1 font-normal text-lg">2GB</span>
                                </p>
                                <p class="">R$ 40,00</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="font-bold text-gray-700">
                                    SSD:
                                    <span class="ml-1 font-normal text-lg">10GB</span>
                                </p>
                                <p class="">R$ 5,00</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="font-bold text-gray-700">
                                    Databases:
                                    <span class="ml-1 font-normal text-lg">1</span>
                                </p>
                                <p class="">R$ 5,00</p>
                            </div>

                            <hr class="my-2">

                            <div class="flex justify-between text-2xl">
                                <p class="font-bold text-gray-700">
                                    TOTAL
                                </p>
                                <p class="font-bold">R$ 75,00</p>
                            </div>

                        </div>
                        <div class="mt-4 px-6 py-4 bg-green-600 font-normal text-center text-gray-100 text-2xl tracking-wide rounded-lg shadow-md">
                            Finalizar
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
