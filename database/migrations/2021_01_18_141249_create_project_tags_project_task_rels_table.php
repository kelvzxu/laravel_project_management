<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTagsProjectTaskRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tags_project_task_rels', function (Blueprint $table) {
            $table->foreignId('project_task_id')->references('id')->on('project_tasks')->onDelete('cascade');
            $table->foreignId('project_tag_id')->references('id')->on('project_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_tags_project_task_rels');
    }
}
