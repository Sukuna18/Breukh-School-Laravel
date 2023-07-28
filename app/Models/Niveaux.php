<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveaux extends Model
{
    use HasFactory;
    protected $table = 'niveaux';
    protected $fillable = [
        'libelle',
    ];
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
