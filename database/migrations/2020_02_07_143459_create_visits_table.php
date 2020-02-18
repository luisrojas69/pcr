<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ci');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->integer('reason_id')->unsigned();
            $table->integer('origin_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->integer('inspector_id')->unsigned();
            $table->integer('guardhouse_id')->unsigned();
            $table->enum('have_car',['si','no'])->default('no')->nullable();
            $table->integer('vehicle_id')->unsigned(); //TO-DO (Por relacion o aparte)
            $table->char('status',  2)->default('SI');
            $table->date('visit_date');
            $table->time('hour_in');
            $table->date('hour_out');
            $table->string('comment')->nullable();
            $table->string('area');
            $table->string('image')->default('contact_default.jpg');
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
        Schema::dropIfExists('visits');
    }
}
