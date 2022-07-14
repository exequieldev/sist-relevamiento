<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HogarInstitucionMedica extends Model
{
    use HasFactory;

    protected $table = "hogarinstitucionmedicas";

    protected $primaryKey = "idhogarInstitucionMedicas";

    protected $fillable = ['idhogar','idInstitucionMedica'];

    public $timestamps=false;

    protected $guarded = [];
}
