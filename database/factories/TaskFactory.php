<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $task_group = TaskGroup::all()->first();
        if ($task_group === null) {
            $task_group = TaskGroup::factory()->create();
        }

        $user = User::all()->first();
        if ($user === null) {
            $user = User::factory()->create();
        }

        $title = $this->faker->text(25);
        return [
            'title' => $title,
            'description' => $this->faker->text(200),
            'priority' => $this->faker->numberBetween(1,10),
            'start_date' => $this->faker->date('Y-m-d', 'now'),
            'end_date' => $this->faker->date('Y-m-d', 'now'),
            'user_id' => $user->id,
            'task_group_id' => $task_group->id,
            'slug' => str_replace('.','', strtolower(implode('-', explode(' ', $title)))),
        ];
    }
}
