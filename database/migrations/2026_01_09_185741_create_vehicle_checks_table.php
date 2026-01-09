<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('vehicle_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('current_odometer');
            $table->date('previous_date');
            $table->integer('previous_odometer');
            $table->timestamps();
        });
    }
};
