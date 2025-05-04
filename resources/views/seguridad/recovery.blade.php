@extends('layouts.auth.app')

@section('title', 'Recuperación de contraseña')

@section('content')
    @component('components.login.header')
        @slot('title', 'Recuperación de Contraseña')
        @slot('subtitle')
            <span class="fs-4">Recupera la contraseña escribiendo tu correo </span>
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






@if ($paso == 'email')
<form method="GET" action="{{ route('post.email') }}">
    @csrf
    <input name="usuarioEmail" placeholder="Tu correo" class="form-control" />
    <div class="d-flex justify-content-between mt-3">
    <button class="btn btn-primary w-100 mt-3 mx-2" type="submit">Enviar código</button>
    <a href="{{route('login')}}" class="btn btn-secondary  w-100 mt-3 mx-2"> Cancelar</a>
    </div>
</form>
@endif

@if ($paso == 'codigo')
<p>Código enviado: {{ $codigo }}</p>
<form method="GET" action="{{ route('post.codigo') }}">
    @csrf
    <input type="hidden" name="usuarioEmail" value="{{ $usuario->usuarioEmail }}">
    <input name="usuarioCodigoVerificacion" placeholder="Código de verificación" class="form-control"/>
    <button class="btn btn-primary w-100 mt-3" type="submit">Validar código</button>
</form>
@endif

@if ($paso == 'password')
<form method="GET" action="{{ route('post.password') }}">
    @csrf
    <input name="usuarioPassword" type="password" placeholder="Nueva contraseña" class="form-control" />
    <input name="usuarioPassword_confirmation" type="password" placeholder="Confirmar contraseña" class="form-control" />
    <input type="hidden" name="email" value="{{ old('email', $usuario->usuarioEmail ?? '') }}">
    <button class="btn btn-primary w-100 mt-3" type="submit">Cambiar contraseña</button>
</form>
@endif


@endsection



