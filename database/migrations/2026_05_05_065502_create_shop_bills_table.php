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
        Schema::create('shop_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->integer('amount');
            $table->string('month'); 
            $table->integer('year'); 
            $table->date('due_date');
            $table->enum('payment_method', ['cash', 'transfer'])->default('cash');
            $table->enum('status', ['unpaid', 'verifying', 'paid', 'overdue'])->default('unpaid');
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_bills');
    }
};
