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
            $table->longText('diagnosis');
            $table->longText('chronic_diagnosis');
            $table->longText('acute_diagnosis');
            $table->longText('social_history');
            $table->longText('post_medical_history');
            $table->longText('allergies');
            $table->longText('drug_allergies');
            $table->longText('food_allergies');
            $table->longText('medication');
            $table->longText('prescription');

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
