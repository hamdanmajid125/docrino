<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

        $table->string('speciality')->nullable();
            $table->string('qualification')->nullable();
            $table->string('blood_group')->nullable();
            $table->unsignedBigInteger('depart_id');
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('designiation')->nullable();
            $table->string('per_patient_time')->nullable();
           $table->json('available_on')->nullable();
           $table->json('available_from')->nullable();
           $table->json('available_to')->nullable();

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
        Schema::dropIfExists('doctors');
    }
}
