@extends('layouts.app')

@section('title', 'Catálogo de Usuarios')

@section('slot')
    <div class="col-12 p-4">
        <h2 class="mb-4">Catálogo de Usuarios</h2>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</button>
        </form>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Alias</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->idUsuario }}</td>
                        <td>
                            @if ($usuario->usuarioImagen)
                            <img src="{{ asset('storage/' . $usuario->usuarioImagen) }}" 
                                 alt="Avatar" 
                                 class="img-fluid rounded-circle" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="avatar-placeholder" style="width: 50px; height: 50px; background-color: #ccc; border-radius: 50%; display: flex; justify-content: center; align-items: center; color: white; font-size: 20px;">
                                {{ strtoupper(substr($usuario->usuarioNombre, 0, 1)) }} <!-- Muestra la inicial del nombre -->
                            </div>
                        @endif
                        <td>{{ $usuario->usuarioAlias }}</td>
                        <td>{{ $usuario->usuarioNombre }}</td>
                        <td>{{ $usuario->usuarioEmail }}</td>
                        <td>{{ $usuario->usuarioEstado }}</td>
                        <td>
                            <a href="{{ route('usuario.edit', $usuario->idUsuario) }}" class="btn btn-sm btn-primary">Editar <i class="bi bi-pencil"></i></a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Paginador -->
        <div>
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection