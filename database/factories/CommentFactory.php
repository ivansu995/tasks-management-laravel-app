<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $task = Task::all()->first();
        if ($task === null) {
            $task = Task::factory()->create();
        }

        $user = User::all()->first();
        if ($user === null) {
            $user = User::factory()->create();
        }

        return [
            'comment' => $this->faker->sentences(3,true),
            'task_id' => $task->id,
            'user_id' => $user->id
        ];
    }
}
