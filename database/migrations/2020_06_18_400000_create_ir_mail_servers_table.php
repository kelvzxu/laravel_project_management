<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrMailServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ir_mail_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('smtp_host');
            $table->integer('smtp_port');
            $table->string('smtp_user');
            $table->string('smtp_pass');
            $table->string('smtp_encryption');
            $table->boolean('smtp_debug');
            $table->integer('sequence');
            $table->boolean('active');
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
        Schema::dropIfExists('ir_mail_servers');
    }
}
