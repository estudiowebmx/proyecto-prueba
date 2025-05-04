<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view("usuario.index", compact('usuarios'));
    }


    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view("usuario.edit", compact('usuario'));
    }


    public function update(Request $request, Usuario $usuario)
{

   // dd($request->hasFile('imagen'), $request->file('imagen'), $request->all());

    $request->validate([
        'alias' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'email' => 'required|email',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
   


    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('usuarios', $filename, 'public');
        $usuario->usuarioImagen = $path;
    }


    /*
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen')->store('usuarios', 'public');
        $usuario->usuarioImagen = $imagen;
    }
        */
    
    $usuario->usuarioAlias = $request->alias;
    $usuario->usuarioNombre = $request->nombre;
    $usuario->usuarioEmail = $request->email;

   

    $usuario->save();

    return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
}

}
