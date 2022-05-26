<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCasa extends Model
{
    use HasFactory;

    protected $table = "detallecasa";

    protected $primaryKey = "idDetalleCasa";

    protected $fillable = ['tipoVivienda','hacinamiento'];

    public $timestamps=false;

    protected $guarded = [];
}
