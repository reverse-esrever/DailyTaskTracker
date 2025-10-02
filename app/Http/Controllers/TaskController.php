<?php

namespace App\Http\Controllers;

use App\Filters\TaskFilter;
use App\Http\Requests\Tasks\FilterTaskRequest;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Task;
use App\Services\CategoryService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

class TaskController extends Controller
{
    public function __construct(public TaskService $service, public CategoryService $categoryService)
    {
        
    }

    public function index(FilterTaskRequest $request){
        $filterParams = $request->validated();

        $tasks = $this->service->getAllUserTasks($filterParams);

        $categories = $this->categoryService->getCurrentUsersCategories();
        
        $info = $this->service->getSummaryInfo();
        
        return view('tasks.index', compact('info', 'tasks', 'categories'));
    }
    public function create(){
        return view('tasks.create');
    }
    public function store(StoreTaskRequest $request){
        $data = $request->validated();

        $this->service->store($data);
        
        return redirect()->back(201);
    }
    public function edit(Request $request,Task $task){
        return view('tasks.edit', compact('task'));
    }
    public function update(UpdateTaskRequest $request, Task $task){

        $data = $request->validated();

        $this->service->update($task ,$data);

        return redirect()->back();
        
    }
    public function destroy(Task $task){
        
        $this->service->delete($task);
        
        return redirect()->back();
    }
    public function changeComplition(Task $task){

        $this->service->changeComplition($task);
        
        return redirect()->back();
    }
}
