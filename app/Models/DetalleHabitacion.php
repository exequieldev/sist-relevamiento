<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleHabitacion extends Model
{
    use HasFactory;

    protected $table = "detallehabitaciones";

    protected $primaryKey = "idDetalleHabitacion";

    protected $fillable = ['nombre','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
