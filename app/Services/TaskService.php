<?php

namespace App\Services;

use App\Filters\Filter;
use App\Filters\TaskFilter;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class TaskService
{
    public function __construct(public TaskFilter $filter)
    {
        
    }

    public function getAllUserTasks(?array $filterParams = null): Collection
    {
        if(!empty($filterParams)){
            $tasks = $this->filter->getFilteredItems($filterParams);
            Session::flashInput($filterParams);
            return $tasks;
        }
        return Auth::user()->tasks;
    }
    public function getUpcomingTasks(): Collection
    {
        return Auth::user()->tasks()
        ->where('due_date', '=', Carbon::today())
        ->where('completed_at', "=", null)
        ->get();
    }

    public function countCompletedTasks(): int
    {
        return Auth::user()->tasks()
            ->where('completed_at', "<>", null)
            ->count();
    }
    public function countOverdueTasks(): int
    {
        return Auth::user()->tasks()
        ->where('due_date', '<', Carbon::today())
        ->where('completed_at', "=", null)
        ->count();
    }
    public function countUpcomingTasks(): int
    {
        return Auth::user()->tasks()
        ->where('due_date', '=', Carbon::today())
        ->where('completed_at', "=", null)
        ->count();
    }
    public function getSummaryInfo(): array{
        $info['all'] = Auth::user()->tasks()->count();
        $info['completed'] = $this->countCompletedTasks();
        $info['overdue'] = $this->countOverdueTasks();
        $info['upcoming'] = $this->countUpcomingTasks();
        return $info;
    }
    public function store(array $data): void
    {
        
        $data['user_id'] = Auth::id();
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
        Gate::authorize('update', $task);
        
        is_null($task->completed_at) 
            ? $task->completed_at = Carbon::now() 
            : $task->completed_at = null;
        $task->save();
        Session::flash("TaskStatusChanged");
    }
}
