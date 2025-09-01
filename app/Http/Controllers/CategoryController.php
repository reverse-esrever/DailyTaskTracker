<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
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
        
    }

    public function create()
    {
        //
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $this->service->checkPolicy('update', $request, $category);
        
        $data = $request->validated();
        
        $this->service->update($data);
    }
    
    public function destroy(Request $request, Category $category)
    {
        $this->service->checkPolicy('delete', $request, $category);
        
        $this->service->delete($category);
    }
}
