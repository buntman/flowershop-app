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
            $table->enum('payment_method', ['online'])->default('online'); //add other payment option in the future
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->date('pickup_date');
            $table->time('pickup_time');
            $table->decimal('total', total:10, places:2);
            $table->enum('status', ['pending', 'ready for pickup', 'completed'])->default('pending');
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
