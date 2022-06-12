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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->year('entrence_year');
            $table->year('graduation_year');
            $table->decimal('cum', 2, 2, true);
            $table->date('graduation_date');
            $table->binary('high_school_title');
            $table->binary('birth_certificate');
            $table->binary('paes');
            $table->binary('health_certificate');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('degree_id');
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('specialization_id')->references('id')->on('specializations');
            $table->foreign('degree_id')->references('id')->on('degrees');
            $table->foreign('applicant_id')->references('id')->on('applicants');
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
        Schema::dropIfExists('applications');
    }
};
