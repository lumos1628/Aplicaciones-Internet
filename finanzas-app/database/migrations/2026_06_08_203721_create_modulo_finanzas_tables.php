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
        // 1. Tabla Consumidores
        Schema::create('consumidores', function (Blueprint $table) {
            $table->id(); // PK (BigInt Auto_Increment)
            $table->string('nombre');
            $table->string('email')->unique();
            $table->timestamps(); // Crea created_at y updated_at
        });

        // 2. Tabla Ingresos
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id(); // PK
            $table->unsignedBigInteger('consumidorId'); // FK
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('descripcion');
            $table->timestamps();

            // Relación e integridad
            $table->foreign('consumidorId')->references('id')->on('consumidores')->onDelete('cascade');
        });

        // 3. Tabla Gastos
        Schema::create('gastos', function (Blueprint $table) {
            $table->id(); // PK
            $table->unsignedBigInteger('consumidorId'); // FK
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('categoria');
            $table->string('descripcion');
            $table->timestamps();

            // Relación e integridad
            $table->foreign('consumidorId')->references('id')->on('consumidores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos');
        Schema::dropIfExists('ingresos');
        Schema::dropIfExists('consumidores');
    }
};
