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

    public function contratos()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function uma()
    {
        return $this->belongsTo(UmaModelo::class, 'id_uma');
    }

    public function condonaciones()
    {
        return $this->hasMany(CondonacionesModelo::class, 'id_cobro');
    }

    public function conceptos()
    {
        return $this->belongsToMany(ConceptosModelo::class, 'cobros_conceptos', 'id_cobro', 'id_concepto');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cobro) {
            do {
                $folio = str_pad(mt_rand(1, 999999999999), 12, '0', STR_PAD_LEFT);
            } while (static::where('folio', $folio)->exists());

            $cobro->folio = $folio;
        });
    }
}
