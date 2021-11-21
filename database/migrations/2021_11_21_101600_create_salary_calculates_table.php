<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryCalculatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_calculates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id')->unique();
            $table->foreign('salary_id')->on('salaries')->references('id')->onDelete('cascade');
            $table->double('clean_salary');
            $table->double('opv')->nullable();
            $table->double('vosms')->nullable();
            $table->double('osms')->nullable();
            $table->double('co')->nullable();
            $table->double('ipn')->nullable();
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
        Schema::dropIfExists('salary_calculates');
    }
}
