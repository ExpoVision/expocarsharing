<?php

use App\Models\VehicleInfo;
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
        Schema::create('vehicle_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('body_type_id')->constrained();
            $table->float('power_reserve');
            $table->enum('power_reserve_unit', array_keys(VehicleInfo::$units))->default();
            $table->float('consumption');
            $table->float('horsepower');
            $table->enum('transmission', array_keys(VehicleInfo::$transmissions));
            $table->boolean('multimedia');
            $table->tinyInteger('seats');
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
        Schema::dropIfExists('vehicle_infos');
    }
};
