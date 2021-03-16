<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_activities', function (Blueprint $table) {
            $table->id();
            $table->string('access_token')->unique();
            $table->string('name')->default('/');
            $table->string('activity_type');
            $table->date('due_date');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->string('state')->default('draft');
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
        Schema::dropIfExists('mail_activities');
    }
}
