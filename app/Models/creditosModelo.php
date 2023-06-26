<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creditosModelo extends Model
{
    use HasFactory;

    protected $table = 'creditos';
    protected $primaryKey = 'id_credito';
    public $timestamps = true;

    protected $fillable = [
        'id_contrato',
        'monto',
        'activo'
    ];

    public function contrato()
    {
        return $this->belongsTo(contratosModelo::class, 'id_contrato');
    }
}
