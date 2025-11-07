<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Customer data
            $table->string('customer_name');
            $table->string('email')->nullable();
            $table->string('id_number')->nullable(); // KTP/SIM
            $table->text('address')->nullable();
            $table->string('phone')->nullable();

            // Rental
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('motor_type')->nullable();
            $table->integer('helmets')->default(0);
            $table->boolean('raincoat')->default(false);
            $table->boolean('phone_holder')->default(false);
            $table->boolean('disk_lock')->default(false);
            $table->string('delivery_place')->nullable();
            $table->string('pickup_place')->nullable();
            $table->string('guarantee')->nullable();

            // Financial
            $table->decimal('rental_fee', 12, 2)->default(0);
            $table->decimal('down_payment', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->nullable();

            $table->text('other_notes')->nullable();

            $table->enum('status_pengiriman', ['Pending', 'Terkirim'])->default('Pending');
            $table->string('pdf_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
