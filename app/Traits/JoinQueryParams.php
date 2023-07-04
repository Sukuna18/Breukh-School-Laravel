<?php

namespace App\Traits;

trait JoinQueryParams
{
    public function joinQuery($query, $join, $table)
    {
        if ($table->contains($join)) {
            return $query->with($join);
        }

        return $query;
    }
}
