<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
    protected $table = 'direcciones';

    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calle',
        'colonia',
        'ciudad',
        'estado',
        'pais',
        'codigoPostal',
        'noExt',
        'noInt',
    ];

}
