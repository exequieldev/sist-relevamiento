<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoSocial extends Model
{
    use HasFactory;

    protected $table = "movimientosociales";

    protected $primaryKey = "idMovimientoSocial";

    protected $fillable = ['nombre','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
