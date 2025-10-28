<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            // relasi ke employee
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

            // tanggal absensi
            $table->date('tanggal');

            // status absensi: hadir, izin, sakit, alpa
            $table->enum('status_absensi', ['hadir', 'izin', 'sakit', 'alpa'])->default('hadir');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropColumn(['employee_id', 'tanggal', 'status_absensi']);
        });
    }
};
