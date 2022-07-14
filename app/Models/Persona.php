<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";

    protected $primaryKey = "idPersona";

    protected $fillable = ['nombres','apellidos','dni','fechaNacimiento','ocupacion','idhogar', 'idVinculo', 'idGenero', 'idNivel', 'idsituacionOcupacional'];

    public $timestamps=false;

    protected $guarded = [];
}
