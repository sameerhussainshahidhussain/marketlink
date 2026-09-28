<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 191)->unique();
            $table->foreignId('customer_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('farmer_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('market_id')->constrained('markets')->restrictOnDelete();
            $table->foreignId('pickup_slot_id')->nullable()->constrained('pickup_slots')->nullOnDelete();
            $table->date('pickup_date');
            $table->time('pickup_start_time');
            $table->time('pickup_end_time');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('pay_at_pickup');
            $table->enum('order_status', [
                'placed',
                'accepted',
                'declined',
                'ready_for_pickup',
                'completed',
                'cancelled'
            ])->default('placed');
            $table->dateTime('cutoff_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
