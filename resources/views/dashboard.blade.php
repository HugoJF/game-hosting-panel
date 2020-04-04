@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('cards.servers')
    <div class="flex justify-center">
        <div class="w-1/3 p-8">
            <div class="mt-8">
                <div class="px-6 py-4 flex justify-between bg-red-600 text-white text-lg rounded-t">
                    <div class="">vCore</div>
                    <div>
                        <span class="font-medium">R$ 50,00</span>
                        <small class="text-xs text-red-200">/100% vCore</small>
                    </div>
                </div>
                <div class="flex p-4 border border-t-0 rounded-b">
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/4 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">25%</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/4 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">50%</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/4 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">75%</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/4 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">100%</div>
                </div>
            </div>
            <div class="mt-8">
                <div class="px-6 py-4 flex justify-between bg-blue-600 text-white text-lg rounded-t">
                    <div class="">RAM</div>
                    <div>
                        <span class="font-medium">R$ 20,00</span>
                        <small class="text-xs text-blue-200">/GB</small>
                    </div>
                </div>
                <div class="flex p-4 border border-t-0 rounded-b">
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/6 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">1GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/6 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">2GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/6 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">3GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/6 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">4GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/6 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">5GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/6 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">6GB</div>
                </div>
            </div>
            <div class="mt-8">
                <div class="px-6 py-4 flex justify-between bg-green-600 text-white text-lg rounded-t">
                    <div class="">Storage</div>
                    <div>
                        <span class="font-medium">R$ 5,00</span>
                        <small class="text-xs text-green-200">/10 GB</small>
                    </div>
                </div>
                <div class="flex p-4 border border-t-0 rounded-b">
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/5 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">10GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/5 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">20GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/5 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">30GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/5 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">40GB</div>
                    <div class="trans flex items-center justify-center py-4 mx-2 w-1/5 bg-gray-100 text-2xl border border-gray-400 cursor-pointer rounded hover:shadow-md">50GB</div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
        <div class="p-4 w-2/3">
            <div class="mt-8">
                <div class="flex items-stretch bg-green-600 overflow-hidden rounded-t-lg">
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        CPU
                    </div>
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white ">
                        <div>
                            <small class="font-light text-xl text-green-200">R$ </small>
                            <span class="font-medium">50</span>
                        </div>
                        <div class="font-normal text-green-200 tracking-tight text-xs">por 100% CPU</div>
                    </div>
                </div>
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    <input class="hidden" id="cpu" name="cpu" type="radio" value="25">
                    <label for="cpu" class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        25%
                    </label>
                    <input class="hidden" id="cpu" name="cpu" type="radio" value="50">
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 bg-gray-900 font-medium text-2xl text-gray-100 rounded-lg cursor-pointer select-none shadow-md">
                        50%
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        75%
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        100%
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <div class="flex items-stretch bg-red-600 overflow-hidden rounded-t-lg">
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        RAM
                    </div>
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white ">
                        <div>
                            <small class="font-light text-xl text-red-200">R$ </small>
                            <span class="font-medium">20</span>
                        </div>
                        <div class="font-normal text-red-200 tracking-tight text-xs">por 1GB</div>
                    </div>
                </div>
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        1GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 bg-gray-900 font-medium text-2xl text-gray-100 rounded-lg cursor-pointer select-none shadow-md">
                        2GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        3GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        4GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        5GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        6GB
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <div class="flex items-stretch bg-blue-600 overflow-hidden rounded-t-lg">
                    <div class="flex items-center flex-grow px-6 mb-1 text-3xl text-gray-100 bg-gray-900 tracking-wide rounded-tl rounded-br-xl shadow-lg">
                        SSD
                    </div>
                    <div class="flex flex-grow-0 flex-column items-center px-8 py-3 text-3xl text-white ">
                        <div>
                            <small class="font-light text-xl text-blue-200">R$ </small>
                            <span class="font-medium">5</span>
                        </div>
                        <div class="font-normal text-blue-200 tracking-tight text-xs">por 10GB</div>
                    </div>
                </div>
                <div class="flex px-2 py-4 bg-gray-100 border border-t-0 rounded-b-lg">
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        10GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        20GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        30GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 text-2xl text-gray-800 border rounded-lg cursor-pointer select-none hover:bg-white hover:text-gray-900 hover:shadow">
                        40GB
                    </div>
                    <div class="trans flex items-center justify-center w-1/4 py-4 mx-2 bg-gray-900 font-medium text-2xl text-gray-100 rounded-lg cursor-pointer select-none shadow-md">
                        50GB
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 w-1/3">
            <div class="mt-8">
                <div class="bg-green-600 rounded-t-lg rounded-b-lg">
                    <div class="flex items-center px-6 py-4 mb-1 text-3xl text-gray-100 bg-gray-900 rounded-t-lg shadow-lg">
                        Total
                    </div>
                    <div class="p-4 bg-gray-100 border border-t-0 rounded-b-lg">
                        <div class="flex flex-col text-xl">
                            <div class="flex justify-between">
                                <span class="">50% CPU</span>
                                <span class="">R$ 25,00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="">2GB RAM</span>
                                <span class="">R$ 40,00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="">10GB SSD</span>
                                <span class="">R$ 5,00</span>
                            </div>
                        </div>
                        <div class="mt-8 px-6 py-4 bg-green-600 font-normal text-center text-gray-100 text-2xl tracking-wide rounded-lg shadow-md">
                            Finalizar
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
