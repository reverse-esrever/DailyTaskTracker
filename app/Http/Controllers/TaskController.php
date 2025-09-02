<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(public TaskService $service)
    {
        
    }

    public function index(){
        $tasks = $this->service->getAllUserTasks();

        return view('tasks.index', compact('tasks'));
    }
    public function create(){
        return view('tasks.create');
    }
    public function store(StoreTaskRequest $request){
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->back();
    }
    public function edit(){
        return view('tasks.edit');
    }
    public function update(UpdateTaskRequest $request, Task $task){

        $data = $request->validated();

        $this->service->update($task ,$data);

        return redirect()->back();

    }
    public function destroy(Task $task){
        $this->service->delete($task);
    }
    public function changeComplition(Task $task){
        $this->service->changeComplition($task);
    }
}
