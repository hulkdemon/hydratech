<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class CondonacionesModelo extends Model
{
    use HasFactory;

    protected $table = 'condonaciones';
    protected $primaryKey = 'id_condonacion';
    public $timestamps = true;

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function contratos()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }
    
}
