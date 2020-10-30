<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{

    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
            $table->timestamps();
			$table->timestamp('deleted_at')->nullable();
        });
    }


    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
