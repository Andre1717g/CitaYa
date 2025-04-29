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
       /* Schema::create('cita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctor')->onDelete('cascade');
            $table->foreignId('paciente_id')->constrained('paciente')->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora');
            $table->text('motivo')->nullable();
            $table->enum('estado', ['Pendiente', 'Confirmada', 'Cancelada', 'Reprogramada', 'Finalizada'])->default('Pendiente');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita');
    }
};
