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
        Schema::create('callcenters', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('assignment');
            $table->string('city');
            $table->string('street');
            $table->string('number');
            $table->string('personone');
            $table->string('phoneone');
            $table->string('emailone');
            $table->string('persontwo');
            $table->string('phonetwo');
            $table->string('emailtwo');
            $table->string('emergency');
            $table->string('keywords');
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
        Schema::dropIfExists('callcenter');
    }
};
