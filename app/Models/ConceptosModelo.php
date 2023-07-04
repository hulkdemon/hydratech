<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConceptosModelo extends Model
{
    use HasFactory;

    protected $table = 'conceptos';
    protected $primaryKey = 'id_concepto';
    public $timestamps = true;

}
