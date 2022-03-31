<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('title');
            $table->string('slug');
            $table->integer('rooms');
            $table->string('price');
            $table->integer('beds');
            $table->integer('bathrooms');
            $table->integer('square');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('image');
            $table->boolean('visible');
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
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign('apartments_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
