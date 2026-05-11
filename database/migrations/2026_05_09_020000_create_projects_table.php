<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // klien
            $table->string('kecamatan_pontianak');
            $table->decimal('budget_awal', 15, 2);
            $table->string('status_k3');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
