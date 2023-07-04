<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassesRessource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'niveau_id' => $this->niveaux_id,
            'annee_scolaire_id' => $this->inscriptions->first()->annee_scolaire_id,
            'eleves' => $this->inscriptions->map(function($inscription){
                return [
                    'id' => $inscription->eleve->id,
                    'nom' => $inscription->eleve->nom,
                    'prenom' => $inscription->eleve->prenom,
                ];
            })
        ];
    }
}
