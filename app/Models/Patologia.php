<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    use HasFactory;

    protected $table = "patologias";

    protected $primaryKey = "idPatologia";

    protected $fillable = ['nombre','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
