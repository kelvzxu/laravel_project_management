<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('access_token')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('sequence');
            $table->string('customer')->nullable();
            $table->string('visibility')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->string('label_tasks')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->boolean('allow_subtasks')->nullable();
            $table->boolean('allow_recurring_tasks')->nullable();
            $table->boolean('rating_active')->nullable(); 
            $table->string('rating_status')->nullable();
            $table->string('rating_status_period')->nullable();
            $table->boolean('allow_timesheets')->nullable();
            $table->boolean('allow_timesheet_timer')->nullable();
            $table->float('cost_hours')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
