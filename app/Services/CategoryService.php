<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{
    public function store(array $data): void{
        Category::create($data);
    }
    public function update(array $data): void{
        Category::update($data);
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