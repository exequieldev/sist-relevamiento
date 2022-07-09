<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    use HasFactory;

    protected $table = "vinculos";

    protected $primaryKey = "idVinculo";

    protected $fillable = ['nombre','estado'];

    public $timestamps=false;

    protected $guarded = [];

    
}
