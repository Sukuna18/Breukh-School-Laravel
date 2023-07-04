<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Js;

class EleveRessource extends JsonResource
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
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'date_naissance' => $this->date_naissance,
            'lieu_naissance' => $this->lieu_naissance,
            'sexe' => $this->gender,
            'profil' => $this->profil,
            'code' => $this->code,
            'actif' => $this->actif,
            'id_classe' => $this->classes_id,
            'classes' => $this->libelle,
        ];
    }
}
