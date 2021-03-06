<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalGovernmentAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_government_areas', function (Blueprint $table) {
            $table->id();
            $table->json('slug');
            $table->json('name');
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->foreignId('country_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('region_id')
                ->nullable()
                ->constrained();
            $table->foreignId('province_id')
                ->nullable()
                ->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('local_government_areas');
    }
}
