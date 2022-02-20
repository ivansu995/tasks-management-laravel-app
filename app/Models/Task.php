<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'start_date',
        'end_date',
        'user_id',
        'task_group_id',
        'slug',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|User[]
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'executes');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Comment[]
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|File[]
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
