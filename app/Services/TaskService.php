<?php

namespace App\Services;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class TaskService
{
    public function getAllUserTasks(): Collection
    {
        return Task::where('id', 'user_id')->get();
    }
    public function store(array $data): void
    {
        $data['user_id'] = Auth::user();
        Task::create($data);
        Session::flash('TaskCreated');
    }
    public function update(Task $task, array $data): void {
        $task->update($data);
        Session::flash('TaskUpdated');
    }
    public function delete(Task $task): void
    {
        Gate::authorize('delete', $task);
        
        $task->delete();
    }
    public function changeComplition(Task $task): void
    {
        is_null($task->complited_at) 
            ? $task->complited_at = Carbon::now() 
            : $task->complited_at = null;
        Session::flash("TaskStatusChanged");
    }
}
