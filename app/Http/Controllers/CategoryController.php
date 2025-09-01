<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $service)
    {
        
    }

    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        
        $this->service->update($category,$data);

        return redirect()->back();
    }
    
    public function destroy(DeleteCategoryRequest $request, Category $category)
    {        
        $this->service->delete($category);

        return redirect()->back();
    }
}
