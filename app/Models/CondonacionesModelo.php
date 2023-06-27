<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CondonacionesModelo extends Model
{
    use HasFactory;

    protected $table = 'condonaciones';
    protected $primaryKey = 'id_condonacion';
    public $timestamps = true;

    public function cobro()
    {
        return $this->belongsTo(CobrosModelo::class, 'id_cobro');
    }

}
