<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratosModelo extends Model
{
    use HasFactory;

    protected $table = 'contratos';
    protected $primaryKey = 'id_contrato';
    public $timestamps = true;

    public function tipos_contratos()
    {
        return $this->belongsTo(TiposContratoModelo::class, 'id_tipo_contrato');
    }

    public function condonaciones()
    {
        return $this->hasMany(CondonacionesModelo::class, 'id_contrato');
    }

    public function cobros()
    {
        return $this->hasMany(CobrosModelo::class, 'id_contrato');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contrato) {
            do {
                $numero_contrato = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
            } while (static::where('numero_contrato', $numero_contrato)->exists());

            $contrato->numero_contrato = $numero_contrato;
        });
    }
}
