<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;
    protected $table = 'disciplines';
    protected $fillable = [
        'libelle',
    ];
    public function classe_disciplines()
    {
        return $this->hasMany(ClasseDiscipline::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
