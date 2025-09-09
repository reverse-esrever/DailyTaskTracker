<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Collection;

interface Filter{
    public function getFilteredItems(array $params): Collection;
}