<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estrellas', function (Blueprint $table) {
            $table->id();
            // FK hacia la tabla posts (Eliminación en cascada)
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            // FK hacia la tabla users (Eliminación en cascada)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Valor de la calificación limitado (1 a 5)
            $table->unsignedTinyInteger('num_estrellas');
            $table->timestamps();

            // Evitar que un mismo usuario califique el mismo post más de una vez
            $table->unique(['post_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estrellas');
    }
};