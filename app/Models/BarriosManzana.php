<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarriosManzana extends Model
{
    use HasFactory;

    protected $table = "barrio_manzanas";

    protected $primaryKey = "idBarrio_Manzanas";

    protected $fillable = ['idBarrio','idManzan'];

    public $timestamps=false;

    protected $guarded = [];
}
