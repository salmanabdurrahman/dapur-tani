<?php

use App\Enums\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 12, 2);
            $table->string('status')->default(OrderStatus::PENDING_PAYMENT->value);
            $table->string('payment_method')->nullable();
            $table->string('payment_gateway_ref')->nullable();
            $table->text('shipping_address');
            $table->text('notes')->nullable();
            $table->string('snap_token')->nullable();
            $table->softDeletes();
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
