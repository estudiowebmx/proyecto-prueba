@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('slot')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title h4 mb-4">Editar Usuario</h2>

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuario.update', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Alias:</label>
                    <input type="text" name="alias" value="{{ old('alias', $usuario->usuarioAlias) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nombre:</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $usuario->usuarioNombre) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico:</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->usuarioEmail) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="cargaImagen" class="btn btn-primary">Adjuntar Foto (JPG, JPEG, PNG):</label>
                    <input type="file" id="cargaImagen" name="imagen" accept="image/png,image/jpeg,image/jpg" class="form-control">
                </div>

                
                    <div class="mb-3">
                        <p class="form-label">Imagen actual:</p>
                        <img id="visorImagen" src="{{ $usuario->usuarioImagen ? asset('storage/' . $usuario->usuarioImagen) :  asset('storage/usuarios/' .'sinImagen.jpg') }}" alt="Imagen de perfil" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="/usuario" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
#cargaImagen{display:none;}
</style>
@endpush
@push('javascript')
<script>
    document.getElementById('cargaImagen').addEventListener('change', function(event) {
        const input = event.target;
        const previewImg = document.getElementById('visorImagen');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
        
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = '';
        }
    });
</script>
@endpush