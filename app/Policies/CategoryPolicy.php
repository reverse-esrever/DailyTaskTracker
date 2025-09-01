<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CategoryPolicy
{
    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
    
    public function delete(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }

    public function edit(User $user, Category $category): bool
    {
        return $user->id === $category->user_id;
    }
}
