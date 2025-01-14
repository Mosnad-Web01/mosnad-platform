<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class SearchService
{
    public static function apply(Builder $query, array $fields, string $searchTerm): Builder
    {
        $query->where(function ($q) use ($fields, $searchTerm) {
            foreach ($fields as $field) {
                $q->orWhere($field, 'like', "%{$searchTerm}%");
            }
        });

        return $query;
    }
}
