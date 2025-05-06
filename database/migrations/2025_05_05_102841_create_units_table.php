<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('unit_number');
            $table->integer('bedrooms');
            $table->float('bathrooms', 3, 1);
            $table->integer('square_feet');
            $table->decimal('rent_amount', 10, 2);
            $table->enum('status', ['vacant', 'occupied', 'maintenance'])->default('vacant');
            $table->text('description')->nullable();
            $table->timestamps(); 
            $table->unique(['property_id', 'unit_number']);
            $table->index('status');
            $table->index('rent_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
