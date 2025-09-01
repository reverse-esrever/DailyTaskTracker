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
        return (bool) $user->id;
    }

    public function update(User $user, Category $category): Response
    {
        return $user->id === $category->user_id
            ? Response::allow()
            : Response::deny();
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
