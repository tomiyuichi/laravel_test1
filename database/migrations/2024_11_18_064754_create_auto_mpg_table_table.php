<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auto_mpg_table', function (Blueprint $table) {
            $table->id();
            // $table->string('column1'); // CSVの列に合わせて定義
            // $table->string('column2');
            $table->string('displacement');
            $table->string('mpg');
            $table->string('cylinders');
            $table->string('horsepower');
            $table->string('weight');
            $table->string('acceleration');
            $table->string('model_year');
            $table->string('origin');
            $table->string('car_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_mpg_table');
    }
};
