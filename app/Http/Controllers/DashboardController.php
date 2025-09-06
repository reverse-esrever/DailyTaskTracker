<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(public TaskService $taskService)
    {
        
    }

    public function index(){
        return view('dashboard.index');
    }

    public function tasks(){
        $tasks = $this->taskService->getAllUserTasks();

        $info = $this->taskService->getSummaryInfo();

        return view('dashboard.tasks', compact('info', 'tasks'));
    }
}
