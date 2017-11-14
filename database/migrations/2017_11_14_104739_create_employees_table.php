<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', 100);
            $table->string('firstname', 100);
            $table->string('otchestvo', 100);
            $table->integer('post_id')->unsigned(); //должность
			$table->integer('department_id')->unsigned(); //отдел
			$table->dateTime('employment date'); //дата приема на работу
            $table->dateTime('birthday'); //день рождения
            $table->string('phone',20);
            $table->string('address',100);
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
        Schema::dropIfExists('employees');
    }
}