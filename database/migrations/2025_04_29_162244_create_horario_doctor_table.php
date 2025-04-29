<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
       /* Schema::create('horario_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctor')->onDelete('cascade');
            $table->string('dia_semana', 15);
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_doctor');
    }
};
