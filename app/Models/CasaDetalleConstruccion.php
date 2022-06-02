<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasaDetalleConstruccion extends Model
{
    use HasFactory;

    protected $table = "casasdetalleconstrucciones";

    protected $primaryKey = "idCasaDetalleConstruccion";

    protected $fillable = ['idCasa','iddetalleConstruccion'];

    public $timestamps=false;

    protected $guarded = [];
}
