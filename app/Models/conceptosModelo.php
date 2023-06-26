<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conceptosModelo extends Model
{
    use HasFactory;

    protected $table = 'conceptos';
    protected $primaryKey = 'id_concepto';
    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'precio',
        'activo'
    ];
}
