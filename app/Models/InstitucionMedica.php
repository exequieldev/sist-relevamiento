<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitucionMedica extends Model
{
    use HasFactory;

    protected $table = "institucionmedicas";

    protected $primaryKey = "idInstitucionMedica";

    protected $fillable = ['nombre','estado','idCategoria'];

    public $timestamps=false;

    protected $guarded = [];
}
