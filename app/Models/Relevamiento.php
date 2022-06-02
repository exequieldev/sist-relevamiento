<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relevamiento extends Model
{
    use HasFactory;

    protected $table = "relevamientos";

    protected $primaryKey = "idRelevamiento";

    protected $fillable = ['fechaDesde','idhogar','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
