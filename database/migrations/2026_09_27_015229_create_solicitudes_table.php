<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('monto_solicitado', 12, 2);
            $table->integer('plazo_meses');
            $table->decimal('ingreso_mensual', 12, 2);
            $table->decimal('egresos_mensuales', 12, 2);
            $table->integer('carga_familiar');
            $table->string('antiguedad_laboral');
            $table->string('dni_archivo')->nullable();
            $table->string('boleta_archivo')->nullable();
            $table->decimal('ratio_deuda_ingreso', 5, 2)->nullable();
            $table->string('calificacion')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};