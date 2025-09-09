<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;


class TaskFilter implements Filter
{

    public function getFilteredItems(array $params): Collection
    {
        $query = Auth::user()->tasks();
        foreach($params as $column => $value){
            if(!is_null($value)){
                $query = $this->query($query, $column, $value);
            }
        }
        return $query->get();
    }
    protected function query(Relation $query,string $column, mixed $value){
        switch($column){
            case "start_date": 
                return $query->where('due_date', '>=', $value);
            case "end_date": 
                return $query->where('due_date', '<=', $value);
            case "upcoming": 
                return $query->where('due_date', '=', Carbon::today());
            case "status": 
                if($value == 'completed'){
                    return $query->where('completed_at', '<>', null);
                }
                if($value == 'not_completed'){
                    return $query->where('completed_at', '=', null);
                }
                return $query;
            default: 
                return $query->where($column, '=', $value);
        }
    }
}