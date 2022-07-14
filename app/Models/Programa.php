<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $table = "programas";

    protected $primaryKey = "idPrograma";

    protected $fillable = ['nombre','estado','idPolitica'];

    public $timestamps=false;

    protected $guarded = [];
}
