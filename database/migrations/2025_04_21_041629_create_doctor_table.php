<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('area_salud', 100);
            $table->text('descripcion_especialidad');
            $table->text('direccion_consultorio');
            $table->text('enlace_google_maps');
            $table->string('correo_electronico', 150)->unique();
            $table->text('contraseña');
            $table->binary('foto_rostro')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctor');
    }
};