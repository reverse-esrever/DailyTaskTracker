<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Facades\Auth;

class makeRecurringTask extends Command implements Isolatable
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-recurring-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make recurring task';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::select('id')->get();

        foreach ($users as $user) {
            $data['name'] = "Составить план на сегодня";
            $data['description'] = "Подготовитсья к сегодняшнему дню, составив распорядок";
            $data['due_date'] = Carbon::today();
            $data['user_id'] = $user->id;
            $data['category_id'] = $user->categories()->first()->id;
            Task::updateOrCreate(
                [
                    'description' => $data['description'],
                    'name' => $data['name'],
                    'user_id' => $data['user_id'],
                ],
                [
                    'updated_at' => Carbon::now(), 
                    'completed_at' => null, 
                    'due_date' => $data['due_date']
                ],
            );
        }
    }
}
