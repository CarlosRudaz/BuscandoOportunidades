<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('emprendedores', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->json('telefonos')->nullable();
            $table->json('celulares')->nullable();
            $table->string('actividad');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('fecha_nacimiento');
            $table->string('billetera_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprendedors');
    }
};
