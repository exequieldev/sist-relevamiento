<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = "ingresos";

    protected $primaryKey = "idIngreso";

    protected $fillable = ['monto','idPersona', 'idOcupacion'];

    public $timestamps=false;

    protected $guarded = [];
}
