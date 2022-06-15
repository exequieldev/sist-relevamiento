<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    use HasFactory;

    protected $table = "casas";

    protected $primaryKey = "idCasa";

    protected $fillable = ['idLote','numeroCasa','estado'];

    public $timestamps=false;

    protected $guarded = [];
}
