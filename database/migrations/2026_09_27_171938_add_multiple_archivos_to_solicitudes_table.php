<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn(['dni_archivo', 'boleta_archivo']);
        });

        Schema::table('solicitudes', function (Blueprint $table) {
            $table->json('dni_archivos')->nullable()->after('antiguedad_laboral');
            $table->json('boleta_archivos')->nullable()->after('dni_archivos');
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn(['dni_archivos', 'boleta_archivos']);
            $table->string('dni_archivo')->nullable();
            $table->string('boleta_archivo')->nullable();
        });
    }
};