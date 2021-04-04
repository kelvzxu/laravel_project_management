<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTaskTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_task_types', function (Blueprint $table) {
            $table->id();
            $table->boolean('active');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('sequence');
            $table->string('legend_blocked')->default('Blocked');
            $table->string('legend_done')->default('Ready');
            $table->string('legend_normal')->default('In Progress');
            $table->boolean('fold')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->foreignId('create_uid')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('write_uid')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_task_types');
    }
}
