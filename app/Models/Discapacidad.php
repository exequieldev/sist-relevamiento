<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    use HasFactory;

    protected $table = "discapacidades";

    protected $primaryKey = "idDiscapacidad";

    protected $fillable = ['cud','idPersona', 'idPatologia'];

    public $timestamps=false;

    protected $guarded = [];
}
