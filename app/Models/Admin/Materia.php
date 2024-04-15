<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materia';
    protected $fillable = ['ID_MATERIA', 'NOMBRE', 'TIPO'];
}
