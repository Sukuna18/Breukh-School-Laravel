<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseDiscipline extends Model
{
    use HasFactory;
    protected $table = 'classe_disciplines';
    protected $fillable = [
        'classe_id',
        'discipline_id',
    ];
}
