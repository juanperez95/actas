<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_pdf extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'elemento',
        'n_serial',
        'n_activo',
    ];

    protected $table = 'historial_actas';
}
