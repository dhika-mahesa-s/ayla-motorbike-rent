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
        Schema::table('invoices', function (Blueprint $table) {
            $table->boolean('cek_lampu_depan')->default(false);
            $table->boolean('cek_lampu_belakang')->default(false);
            $table->boolean('cek_lampu_signal_kanan')->default(false);
            $table->boolean('cek_lampu_signal_kiri')->default(false);
            $table->boolean('cek_kaca_spion')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'cek_lampu_depan',
                'cek_lampu_belakang',
                'cek_lampu_signal_kanan',
                'cek_lampu_signal_kiri',
                'cek_kaca_spion'
            ]);
        });
    }
};
