<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $fillable = [
        'libelle',
    ];
    public function niveaux()
    {
        return $this->belongsTo(Niveaux::class, 'niveaux_id');
    }
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }
    public function inscriptions()
    {
        $annee = AnneeScolaire::where('statut', true)->first();

        return $this->hasMany(Inscriptions::class)
            ->where('annee_scolaire_id', $annee->id);
    }
    public function classe_discipline()
    {
        return $this->hasMany(ClasseDiscipline::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_classes');
    }
}
