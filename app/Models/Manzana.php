<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manzana extends Model
{
    use HasFactory;

    protected $table = "manzanas";

    protected $primaryKey = "idManzana";

    protected $fillable = ['numero','division','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
