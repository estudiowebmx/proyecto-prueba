<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('usuario.index');
        }
        return view('seguridad.login');
    }

    public function acceso(Request $request)
    {

        $request->validate([
            'usuarioAlias' => 'required',
            'usuarioPassword' => 'required',
        ], [
            'usuarioAlias.required' => 'Debes ingresar tu usuario.',
            'usuarioPassword.required' => 'Debes ingresar tu contraseña.',
        ]);

        $usuario = Usuario::where('usuarioAlias', $request->usuarioAlias)->first();

        if ($usuario && Hash::check($request->usuarioPassword, $usuario->usuarioPassword)) {
            Auth::login($usuario);
            return redirect()->route('usuario.index');
        }

        return back()->withErrors([
            'usuarioAlias' => 'Credenciales incorrectas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/seguridad/login');
    }


    //! Hacer todo el recovery de contraseña en una sola vista

    public function recuperarPassword()
    {
        return view('seguridad.recovery', ['paso' => 'email']);
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'usuarioEmail' => 'required|email|exists:seg_usuario,usuarioEmail',
        ], [
            'usuarioEmail.required' => 'Debes escribir un correo.',
            'usuarioEmail.email' => 'El correo debe ser válido.',
            'usuarioEmail.exists' => 'El correo no existe en nuestros registros.',
        ]);

        session(['usuarioEmail' => $request->usuarioEmail]);
        $usuario = Usuario::where('usuarioEmail', $request->usuarioEmail)->first();
        $codigoValido = $usuario->usuarioCodigoVerificacion;
        $generadoHace = $usuario->usuarioCodigoGeneradoAt;
        if (!$codigoValido || !$generadoHace || now()->diffInMinutes($generadoHace) > 10) {
            $codigo = rand(100000, 999999);
            $usuario->usuarioCodigoVerificacion = $codigo;
            $usuario->usuarioCodigoGeneradoAt = now();
            $usuario->save();
        } else {
            $codigo = $codigoValido;
        }

        /*
! El envio del correo se simulará por tema de servidor de correo y configuraciones.
        Mail::raw("Tu código de recuperación es: $codigo", function ($message) use ($usuario) {
            $message->to($usuario->usuarioEmail)
                    ->subject('Código de recuperación');
        });
*/
        return view('seguridad.recovery', [
            'paso' => 'codigo',
            'usuario' => $usuario,
            'codigo' => $codigo
        ]);
    }

    public function postCodigo(Request $request)
    {
        $request->validate([
            'usuarioCodigoVerificacion' => 'required|digits:6',
        ], [
            'usuarioCodigoVerificacion.required' => 'Debes escribir un código',
            'usuarioCodigoVerificacion.digits' => 'El código debe tener 6 digitos'
        ]);

        $usuario = Usuario::where('usuarioEmail', $request->usuarioEmail)->first();

        if ($usuario->usuarioCodigoVerificacion != $request->usuarioCodigoVerificacion) {
            return back()->withErrors(['usuarioCodigoVerificacion' => 'El código ingresado es incorrecto.'])
                ->withInput();
        }

        return view('seguridad.recovery', ['paso' => 'password']);
    }

    public function postPassword(Request $request)
    {
        $request->validate([
            'usuarioPassword' => 'required|min:8|confirmed',
        ], [
            'usuarioPassword.required' => 'Debes escribir una contraseña.',
            'usuarioPassword.min' => 'La contraseña debe tener 8 caracteres como mínimo.',
            'usuarioPassword.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $email = session('usuarioEmail');
        $usuario = Usuario::where('usuarioEmail', $email)->first();


        $usuario->usuarioPassword = Hash::make($request->usuarioPassword);
        $usuario->usuarioCodigoVerificacion = null; // Limpiar el código por seguridad
        $usuario->save();
        return redirect()->route('login')->with('success', 'Contraseña restablecida, acceda con la nueva contraseña.');
    }
}
