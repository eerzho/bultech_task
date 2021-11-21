<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id')->unique();
            $table->foreign('salary_id')->on('salaries')->references('id')->onDelete('cascade');
            $table->boolean('is_invalid');
            $table->boolean('invalid_group')->nullable();
            $table->boolean('is_retired');
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
        Schema::dropIfExists('salary_options');
    }
}
