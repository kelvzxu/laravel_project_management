<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('access_token')->nullable();
            $table->string('email_cc')->nullable();
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('priority')->nullable();
            $table->integer('sequence')->nullable();
            $table->foreignId('stage_id')->references('id')->on('project_task_types')->onDelete('cascade');
            $table->string('kanban_state')->default('normal');
            $table->timestamp('date_end')->nullable();
            $table->timestamp('date_assign')->nullable();
            $table->timestamp('date_last_stage_update')->nullable();
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->float('planned_hours')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->string('color')->nullable();
            $table->foreignId('displayed_image_id')->nullable()->references('id')->on('ir_attachments')->onDelete('cascade');
            $table->string('email_from')->nullable();
            $table->float('working_hours_open')->default(0);
            $table->float('working_hours_close')->default(0);
            $table->float('working_days_open')->default(0);
            $table->float('working_days_close')->default(0);
            $table->float('remaining_hours')->default(0);
            $table->float('effective_hours')->default(0);
            $table->float('total_hours_spent')->default(0);
            $table->float('progress')->default(0);
            $table->float('overtime')->default(0);
            $table->float('subtask_effective_hours')->default(0);
            $table->foreignId('create_uid')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('write_uid')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_tasks');
    }
}
