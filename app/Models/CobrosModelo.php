<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobrosModelo extends Model
{
    use HasFactory;

    protected $table = 'cobros';
    protected $primaryKey = 'id_cobro';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function autorizador()
    {
        return $this->belongsTo(RolModelo::class, 'id_autorizador');
    }

    public function uma()
    {
        return $this->belongsTo(UmaModelo::class, 'id_uma');
    }
}
