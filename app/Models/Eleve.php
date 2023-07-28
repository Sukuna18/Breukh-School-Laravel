<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Eleve extends Model
{
    use Notifiable;
    use HasFactory;
    protected $table = 'eleves';
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'gender',
        'profil',
        'actif',
        'email'
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
    public function notes()
    {
        return $this->hasMany(Notes::class);
    }
}
