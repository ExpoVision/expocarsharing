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
        Schema::create('user_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('card_number')->unqiue();
            $table->smallInteger('expdate_year');
            $table->tinyInteger('expdate_month');
            $table->smallInteger('cvv');
            $table->string('holder_name');
            $table->string('holder_surname');

            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('user_pays');
    }
};
