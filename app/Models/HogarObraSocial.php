<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HogarObraSocial extends Model
{
    use HasFactory;

    protected $table = "hogarobrasociales";

    protected $primaryKey = "idhogarObraSociales";

    protected $fillable = ['idhogar','idObraSocial'];

    public $timestamps=false;

    protected $guarded = [];
}
