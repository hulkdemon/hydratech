<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditosModelo extends Model
{
    use HasFactory;

    protected $table = 'creditos';
    protected $primaryKey = 'id_credito';
    public $timestamps = true;

    public function contrato()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }
}
