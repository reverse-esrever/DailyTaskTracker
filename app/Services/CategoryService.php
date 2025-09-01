<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    public function store(array $data): void{
        $data['user_id'] = Auth::id();
        Category::create($data);
        Session::flash('CategoryCreated');
    }
    public function update(Category $category,array $data): void{
        $category->update($data);
        Session::flash('CategoryUpdated');
    }
    public function delete(Category $category): void{
        $category->delete();
    }
    
    public function checkPolicy(string $action, Request $request, ?Category $category = null){
        if(! $request->user()->can($action, $category ?: Category::class)){
            abort(403);
        }
    }
}