@extends('layouts.app')

@section('content')
    <h1 class="font-thin text-center text-5xl text-gray-800 tracking-wider">Configuração</h1>

    {!! Form::open(['method' => 'POST', 'url' => route('servers.store', [$game, $location])]) !!}

    <!-- Period -->
    <div class="form-group">
        <label for="period">CPU</label>
        <select name="period" class="form-control" id="period">
            <option value="minutely">Minutely</option>
            <option value="hourly">Hourly</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>
    </div>

    <!-- Name -->
    <div class="form-group">
        <label for="name">Name</label>
        <input name="name" class="form-control" id="name"/>
    </div>

    <!-- CPU -->
    <div class="form-group">
        <label for="cpu">CPU</label>
        <select name="cpu" class="form-control" id="cpu">
            <option value="20">20%</option>
            <option value="40">40%</option>
            <option value="60">60%</option>
            <option value="80">80%</option>
            <option value="100">100%</option>
        </select>
    </div>

    <!-- RAM -->
    <div class="form-group">
        <label for="ram">RAM</label>
        <select name="ram" class="form-control" id="ram">
            <option value="1">1GB</option>
            <option value="2">2GB</option>
            <option value="3">3GB</option>
            <option value="4">4GB</option>
            <option value="5">5GB</option>
        </select>
    </div>

    <!-- Disk -->
    <div class="form-group">
        <label for="disk">Disk</label>
        <select name="disk" class="form-control" id="disk">
            <option value="10">10GB</option>
            <option value="20">20GB</option>
            <option value="30">30GB</option>
            <option value="40">40GB</option>
            <option value="50">50GB</option>
            <option value="60">60GB</option>
        </select>
    </div>

    <!-- Databases -->
    <div class="form-group">
        <label for="databases">Databases</label>
        <select name="databases" class="form-control" id="databases">
            <option value="1">1 database</option>
            <option value="2">2 databases</option>
            <option value="3">3 databases</option>
            <option value="4">4 databases</option>
        </select>
    </div>

    <button class="btn btn-lg btn-block btn-success" type="submit">Criar servidor</button>

    {!! Form::close() !!}
@endsection
