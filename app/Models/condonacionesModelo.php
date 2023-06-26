<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class condonacionesModelo extends Model
{
    use HasFactory;

    protected $table = 'condonaciones';
    protected $primaryKey = 'id_condonacion';
    public $timestamps = true;

    protected $fillable = [
        'id_cobro',
        'descuento',
        'porcentaje',
        'inicio_vigencia',
        'fin_vigencia'
    ];

    public function cobro()
    {
        return $this->belongsTo(cobrosModelo::class, 'id_cobro');
    }

}
