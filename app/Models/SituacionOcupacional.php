<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SituacionOcupacional extends Model
{
    use HasFactory;

    protected $table = "situacionesocupacionales";

    protected $primaryKey = "idsituacionesOcupacionales";

    protected $fillable = ['nombre','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
