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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->string('invoice_number')->unique()->nullable();
            $table->enum('order_type', ['pickup', 'delivery'])->default('pickup');
            $table->string('delivery_location')->nullable();
            $table->integer('delivery_fee')->default(0);
            $table->integer('total_price');
            $table->enum('payment_method', ['cash', 'transfer'])->default('cash');
            $table->enum('payment_status', ['unpaid', 'verifying', 'paid', 'failed'])->default('unpaid');
            $table->string('payment_proof')->nullable();
            $table->enum('status', ['pending', 'processing', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
