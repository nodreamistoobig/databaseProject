<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('school_id')->unsigned();
			$table->integer('program_id')->unsigned();
			$table->string('level');
			$table->integer('teacher_id')->unsigned();
            $table->timestamps();
			$table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
