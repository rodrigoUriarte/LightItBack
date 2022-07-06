<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricDiagnostics extends Migration
{
    public function up()
    {
        Schema::create('historic_diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('historic_diagnosis_id');
            $table->string('name',300);
            $table->integer('accuracy');
            $table->string('icd',200);
            $table->string('icd_name', 500);
            $table->string('prof_name',500);
            $table->integer('ranking');
            $table->boolean('confirmed')->nullable();
            //

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historic_diagnostics');
    }
}
