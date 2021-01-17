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
            $table->string('description')->nullable();
            $table->boolean('active')->default(false);
            $table->integer('sequence');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->string('label_tasks')->nullable();
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('allow_subtasks');
            $table->boolean('allow_recurring_tasks');
            $table->boolean('rating_active');
            $table->string('rating_status');
            $table->string('rating_status_period');
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
