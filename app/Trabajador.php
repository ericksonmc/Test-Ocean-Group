<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = "trabajadors";

    protected $fillable = [
        'nombre', 'apellido', 'cedula','cargo', 'isActive'
    ];
}
