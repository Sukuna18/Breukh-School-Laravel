<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $actionMethod = $request->route()->getActionMethod();
        $data = [
            'id' => $this->id,
            'note' => $this->note,
            'evaluation' => $this->classe_discipline->evaluation->libelle,
            'eleve' => $this->inscriptions->eleve->prenom . ' ' . $this->inscriptions->eleve->nom,
            'id_eleve' => $this->inscriptions->eleve->id,
            'discipline' => $this->whenLoaded('classe_discipline', function () {
                return $this->classe_discipline->discipline->libelle;
            }),
        ];
            if($actionMethod === 'getNotesByClasse' || $actionMethod === 'getAllNotesEleveByClasse' || $actionMethod === 'getNotesByEleve'){
                $data['classe'] = $this->whenLoaded('classe_discipline', function () {
                    return $this->classe_discipline->classes->libelle;
                });
            }
        return $data;
    }
}
