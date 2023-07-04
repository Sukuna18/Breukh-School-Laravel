<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Eleve extends Model
{
    use HasFactory;
    protected $table = 'eleves';
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'gender',
        'profil',
        'actif'
    ];
    public function __construct()
    {
        
    }
    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
    public function inscriptions()
    {
        return $this->hasMany(Inscriptions::class);
    }
    
    
}
