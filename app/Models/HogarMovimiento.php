<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HogarMovimiento extends Model
{
    use HasFactory;

    protected $table = "hogaresmovimientos";

    protected $primaryKey = "idhogaresMovimientos";

    protected $fillable = ['idMovimientoSocial','idhogar'];

    public $timestamps=false;

    protected $guarded = [];
}
