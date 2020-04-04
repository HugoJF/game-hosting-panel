@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Coupon <strong>{{ $coupon->id }}</strong></h1>
                    <br/>
                    <h3>
                        <span>Value: </span>
                        <span class="badge badge-success">R$ {{ round($coupon->value / 100, 2) }}</span>
                    </h3>
                    <br/>
                    @component('partials.form', ['method' => 'POST', 'url' => route('coupons.use', $coupon)])
                    <button class="btn btn-outline-success btn-lg">Use</button>
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection