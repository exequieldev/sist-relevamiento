<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HogarPrograma extends Model
{
    use HasFactory;

    protected $table = "hogaresprogramas";

    protected $primaryKey = "idhogaresProgramas";

    protected $fillable = ['cantidad','idPrograma','idhogar'];

    public $timestamps=false;

    protected $guarded = [];
}
