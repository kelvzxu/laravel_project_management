<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('personal_team');
            $table->string('team_type')->default('private');
            $table->foreignId('banner_image_id')->nullable()->references('id')->on('ir_attachments');
            $table->foreignId('team_image_id')->nullable()->references('id')->on('ir_attachments');
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
        Schema::drop('teams');
    }
}
