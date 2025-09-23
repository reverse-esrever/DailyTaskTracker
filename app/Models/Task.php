<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'due_date', 'completed_at', 'user_id', 'category_id','updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
