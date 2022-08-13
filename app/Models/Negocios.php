<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocios extends Model
{
    protected $table = 'negocios';


    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUsuario',
        'horaApertura',
        'horaCierre',
        'descripcion',
        
    ];
}
