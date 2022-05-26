<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    use HasFactory;

    protected $table = "habitaciones";

    protected $primaryKey = "idHabitacion";

    protected $fillable = ['nombre','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
