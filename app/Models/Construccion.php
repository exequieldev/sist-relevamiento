<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Construccion extends Model
{
    use HasFactory;

    protected $table = "construcciones";

    protected $primaryKey = "idConstruccion";

    protected $fillable = ['nombre'];

    public $timestamps=false;

    protected $guarded = [];
}
