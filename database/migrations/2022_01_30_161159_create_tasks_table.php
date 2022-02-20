<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191); //255 karaktera
            $table->text('description');
            $table->enum('priority', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('finished', ['Yes', 'No'])->default('No');
            $table->enum('canceled', ['Yes', 'No'])->default('No');
            $table->string('slug',255);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_group_id');
            $table->timestamps(); //created_at updated_at

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('task_group_id')
                ->references('id')
                ->on('task_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
