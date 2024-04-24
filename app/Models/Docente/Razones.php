<?php

namespace App\Models\Docente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razones extends Model
{
    use HasFactory;

    protected $table = 'razones';
    public $timestamps = false;
    protected $primaryKey = 'id_razones';
    protected $fillable = [
        'razon',
    ];

}
