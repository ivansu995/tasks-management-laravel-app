<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task_group_name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|Task
     */
    public function task()
    {
        return $this->hasOne(Task::class);
    }
}
