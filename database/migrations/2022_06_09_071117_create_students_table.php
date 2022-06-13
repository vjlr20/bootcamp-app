<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('names', 150);
            $table->string('lastnames', 200);
            $table->date('birthday');
            $table->foreignId('city_id')->constrained();
            $table->string('address');
            $table->string('email')->unique();
            $table->smallInteger('phone');
            $table->tinyInteger('status', false, 3)->default(1);
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
        Schema::dropIfExists('students');
    }
};
