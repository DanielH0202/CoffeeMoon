<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repartidores extends Model
{
    protected $table = 'repartidores';

    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUsuario',
        'fechaRegistro',
        'fechaNacimiento',
        'sexo',
        
    ];
}
