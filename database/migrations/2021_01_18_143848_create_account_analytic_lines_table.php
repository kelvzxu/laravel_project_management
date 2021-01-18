<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAnalyticLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_analytic_lines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('/');
            $table->date('date');
            $table->float('amount')->default(0);
            $table->float('unit_amount')->default(0);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreignId('task_id')->references('id')->on('project_tasks')->onDelete('cascade');
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->boolean('validate');
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
        Schema::dropIfExists('account_analytic_lines');
    }
}
