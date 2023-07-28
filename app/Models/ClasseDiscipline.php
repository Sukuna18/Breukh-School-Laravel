<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseDiscipline extends Model
{
    use HasFactory;
    protected $table = 'classe_disciplines';
    protected $fillable = [
        'classes_id',
        'discipline_id',
        'evaluation_id',
        'note',
        'max_note'
    ];
    public function classes()
    {
        return $this->belongsTo(Classes::class);
    }
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
