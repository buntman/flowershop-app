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
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('payment_method', ['Cash on Pickup', 'Online Payment']);
            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->decimal('total', total:10, places:2);
            $table->enum('status', ['Pending', 'Ready for Pickup', 'Completed'])->default('Pending');
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
