@extends('layouts.app')

@section('content')
    <h1>
        @lang('orders.create')
    </h1>
    <br/>
    <h2>
        @lang('orders.select_amount'):
    </h2>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="flex flex-wrap justify-center">
                <div class="flex justify-center my-4 mx-6">
                    <div class="trans px-8 py-2 bg-gray-100 rounded shadow cursor-pointer hover:shadow-lg hover:bg-white">
                        <a href="{{ route('orders.store', 10) }}" class="flex items-baseline text-5xl font-medium text-gray-800 tracking-tight no-underline">
                            <small class="mr-2 text-2xl font-light text-gray-600">R$</small>
                            <span>10,00</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center my-4 mx-6">
                    <div class="trans px-8 py-2 bg-gray-100 rounded shadow cursor-pointer hover:shadow-lg hover:bg-white">
                        <a href="{{ route('orders.store', 20) }}" class="flex items-baseline text-5xl font-medium text-gray-800 tracking-tight no-underline">
                            <small class="mr-2 text-2xl font-light text-gray-600">R$</small>
                            <span>20,00</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center my-4 mx-6">
                    <div class="trans px-8 py-2 bg-gray-100 rounded shadow cursor-pointer hover:shadow-lg hover:bg-white">
                        <a href="{{ route('orders.store', 50) }}" class="flex items-baseline text-5xl font-medium text-gray-800 tracking-tight no-underline">
                            <small class="mr-2 text-2xl font-light text-gray-600">R$</small>
                            <span>50,00</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center my-4 mx-6">
                    <div class="trans px-8 py-2 bg-gray-100 rounded shadow cursor-pointer hover:shadow-lg hover:bg-white">
                        <a href="{{ route('orders.store', 100) }}" class="flex items-baseline text-5xl font-medium text-gray-800 tracking-tight no-underline">
                            <small class="mr-2 text-2xl font-light text-gray-600">R$</small>
                            <span>100,00</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
