<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";

    protected $primaryKey = "idPersona";

    protected $fillable = ['vinculo','nombres','apellidos','dni','fechaNacimiento','ocupacion','idhogar'];

    public $timestamps=false;

    protected $guarded = [];
}
