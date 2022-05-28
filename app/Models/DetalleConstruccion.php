<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleConstruccion extends Model
{
    use HasFactory;

    protected $table = "detalleconstrucciones";

    protected $primaryKey = "iddetalleConstruccion";

    protected $fillable = ['nombre','estado','idConstruccion'];

    public $timestamps=false;

    protected $guarded = [];
}
