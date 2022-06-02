<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;

    protected $table = "telefonos";

    protected $primaryKey = "idTelefono";

    protected $fillable = ['idCasa','numero'];

    public $timestamps=false;

    protected $guarded = [];
}
