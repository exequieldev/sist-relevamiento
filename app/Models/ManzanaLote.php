<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManzanaLote extends Model
{
    use HasFactory;

    protected $table = "manzana_lotes";

    protected $primaryKey = "idManzana_Lote";

    public $timestamps=false;

    protected $guarded = [];
}
