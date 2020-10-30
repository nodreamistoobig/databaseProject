<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
			$table->string('last_name');
			$table->string('first_name');
			$table->string('father_name')->nullable();
			$table->date('birthday');
			$table->string('phone');
			$table->string('status');
            $table->timestamps();
			$table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
