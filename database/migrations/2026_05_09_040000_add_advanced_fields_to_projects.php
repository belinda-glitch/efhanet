<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('service_type')->default('Survey & Design'); // Survey & Design, Installation Services, Network Optimization, Power Solutions
            $table->integer('technical_progress')->default(0);
            $table->string('daily_toolbox_status')->nullable();
            $table->string('work_status')->default('Active'); // Active, On-Hold, Completed
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['service_type', 'technical_progress', 'daily_toolbox_status', 'work_status']);
        });
    }
};
