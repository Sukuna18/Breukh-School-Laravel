<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscriptions extends Model
{
    use HasFactory;
    protected $table = 'inscriptions';
    protected $fillable = [
        'eleve_id',
        'classes_id',
        'annee_scolaire_id',
    ];
    public function eleve(): BelongsTo{
        return $this->belongsTo(Eleve::class);
    }
    public function classes(): BelongsTo{
        return $this->belongsTo(Classes::class);
    }
    public function annee_scolaire(): BelongsTo{
        return $this->belongsTo(AnneeScolaire::class);
    }
    public function notes(){
        return $this->hasMany(Note::class);
    }
}
