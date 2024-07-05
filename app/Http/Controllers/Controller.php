<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function paginate($query, $limit = 15, $usePagination = true, $orderBy = "created_at", $direction = "desc")
    {
        if ($usePagination === 'false' || $usePagination === false)
            return $query->orderBy($orderBy, $direction)->get();

        return $query->orderBy($orderBy, $direction)->paginate($limit)->setPath("")->withQueryString();
    }
}
