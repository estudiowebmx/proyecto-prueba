<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $table = 'seg_usuario';
    protected $primaryKey = "idUsuario";
    public $timestamps = false;
    protected $fillable = [
        'usuarioAlias',
        'usuarioPassword',
        'usuarioNombre',
        'usuarioEmail',
        'usuarioEstado',
        'usuarioConectado',
        'usuarioUltimaConexión',
    ];


    public function getAuthPassword()
    {
        return $this->usuarioPassword;
    }

    public function getAuthIdentifierName()
    {
        return 'usuarioAlias';
    }



    //todo Eliminar los metodos que no sirvan despues de implementar el mio
    public function conectar($id, $token)
    {
        $row = Usuario::find($id);
        if ($row) {
            $fecha = date("Y-m-d H:i:s");
            $row->usuarioUltimaConexion = $fecha;
            $row->save();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function desconectar($id)
    {
        $row = Usuario::find($id);
        if ($row) {
            $row->save();
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtenerUsuario($usuarioAlias)
    {
        $usuario = $this->whereRaw("usuarioAlias = BINARY '" . $usuarioAlias . "'")->get()->first();
        return $usuario;
    }

    function guardarSesion($idUsuario)
    {
        $usuario = $this->find($idUsuario);
        $usuario->usuarioUltimaConexion = date('Y-m-d H:i:s');
        $usuario->save();
        return true;
    }
}
