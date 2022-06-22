<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasaHabitacion extends Model
{
    use HasFactory;

    protected $table = "casahabitaciones";

    protected $primaryKey = "idCasaHabitacion";

    protected $fillable = ['idCasa','idDetalleHabitacion'];

    public $timestamps=false;

    protected $guarded = [];
}
