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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('prescription_id');
            $table->string('title');
            $table->text('description');
            $table->string('diagnosis');
            $table->string('chronic_diagnosis');
            $table->string('acute_diagnosis');
            $table->string('social_history');
            $table->string('post_medical_history');
            $table->string('allergies');
            $table->string('drug_allergies');
            $table->string('food_allergies');
            $table->string('medication');
            $table->string('prescription');
            $table->string('status')->default("off");
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('prescriptions');
    }
};
