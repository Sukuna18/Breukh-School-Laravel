<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeScolaire extends Model
{
    use HasFactory;
    protected $table = 'annee_scolaires';
    protected $fillable = [
        'libelle',
        'date_debut',
        'date_fin',
        'statut'
    ];
    public function inscriptions()
    {
        return $this->hasMany(Inscriptions::class);
    }
}
