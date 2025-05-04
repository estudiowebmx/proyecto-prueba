@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')
    @component('components.login.header')
        @slot('title', 'Bienvenido')
        @slot('subtitle')
            <span class="fs-4">Iniciar sesión </span>
        @endslot
    @endcomponent

    @if ($errors->any())
    <div class="alert alert-danger" id="alertContainer">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form id="formLogin" method="post" action="{{ route('login.acceso') }}" class="my-5">
        @csrf
        <label class="input-group mb-3">
            <input id="usuarioAlias" type="text" class="form-control" name="usuarioAlias" 
                autocomplete="off" autofocus placeholder="Usuario" aria-label="usuario" aria-describedby="usuario">
        </label>
        <label class="input-group mb-3">
            <input placeholder="Contraseña" aria-label="contraseña" aria-describedby="Contraseña" id="password"
                type="password" class="form-control" name="usuarioPassword"  autocomplete="current-password">
        </label>

        <a href="{{ route('recuperar_password') }}">Olvidé mi contraseña</a>

        <button type="submit" class="btn btn-dark w-100 mt-3">Iniciar</button>
    </form>
@endsection