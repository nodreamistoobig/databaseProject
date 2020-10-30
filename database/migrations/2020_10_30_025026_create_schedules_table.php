<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
			$table->morphs("schedulable");
			$table->string("day_of_week");
			$table->time("start_time", 0);
			$table->time("end_time", 0);
			$table->integer("classroom_id");
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
