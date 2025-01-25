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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('numero_documento')->unique();
            $table->date('fecha_ingreso');
            $table->string('origen');
            $table->string('titulo');
            $table->integer('numero_folios');
            $table->text('detalles')->nullable();
            $table->string('derivado')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->foreignId('trabajador_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
