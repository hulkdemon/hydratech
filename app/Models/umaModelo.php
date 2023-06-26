<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class umaModelo extends Model
{
    use HasFactory;

    protected $table = 'uma';
    protected $primaryKey = 'id_uma';
    public $timestamps = true;

    protected $fillable = [
        'valor',
        'fecha_aplicacion',
        'fecha_vigencia'
    ];
}
