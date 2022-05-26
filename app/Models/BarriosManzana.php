<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarriosManzana extends Model
{
    use HasFactory;

    protected $table = "barrios_manzanas";

    protected $primaryKey = "idBarrio_Manzanas";


    public $timestamps=false;

    protected $guarded = [];
}
