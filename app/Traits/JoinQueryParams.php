<?php

namespace App\Traits;

use App\Http\Resources\ClassesRessource;

trait JoinQueryParams
{
    private function joinWith($query, $join)
    {
        if (in_array($join, $this->tableAssoc())) {
            return $query->with($join);
        }

        return $query;
    }

    private function joinLoad($query, $join)
    {
        if (in_array($join, $this->tableAssoc())) {
            return $query->load($join);
        }

        return $query;
    }

    public function jointure($model, $join, $with)
    {
        if ($with) {
            return $this->joinWith($model, $join);
        } else {
            return $this->joinLoad($model, $join);
        }
    }
    private function tableAssoc(){
        $validAssociations = ['niveaux', 'inscriptions', 'classe_discipline'];
        return $validAssociations;
    }
}
