<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hogar extends Model
{
    use HasFactory;

    protected $table = "hogares";

    protected $primaryKey = "idhogar";

  

    public $timestamps=false;

    protected $guarded = [];
}
