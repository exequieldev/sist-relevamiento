<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embarazo extends Model
{
    use HasFactory;

    protected $table = "embarazos";

    protected $primaryKey = "idEmbarazo";

    protected $fillable = ['mesesEmbarazo','idPersona'];

    public $timestamps=false;

    protected $guarded = [];
}
