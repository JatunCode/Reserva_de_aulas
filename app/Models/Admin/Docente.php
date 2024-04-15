<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docente';
    protected $fillable = ['ID_DOCENTE', 'NOMBRE', 'GRUPO', 'CELULAR', 'EMAIL'];
    
}
