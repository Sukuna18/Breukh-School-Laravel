<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table = 'notes';
    protected $fillable = [
        'eleve_id',
        'classe_discipline_id',
        'annee_scolaire_id',
        'note',
    ];
    public function classe_discipline()
    {
        return $this->belongsTo(ClasseDiscipline::class);
    }
    public function annee_scolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }
    public function inscriptions()
    {
        return $this->belongsTo(Inscriptions::class);
    }

}
