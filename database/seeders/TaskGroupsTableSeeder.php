<?php

namespace Database\Seeders;

use App\Models\TaskGroup;
use Illuminate\Database\Seeder;

class TaskGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task_group = new TaskGroup();
        $task_group->task_group_name = 'Grupa 2';
        $task_group->save();

        TaskGroup::create([
            'task_group_name' => 'Grupa 3',
        ]);
    }
}
