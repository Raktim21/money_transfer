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
        Schema::create('money_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('receiver_id')->nullable()->constrained('users');
            $table->float('amount_foreign');
            $table->foreignId('currency_id')->constrained('curencies');
            $table->float('amount_tk');
            $table->float('exchange_rate');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_address');
            $table->string('payment_method');
            $table->tinyInteger('sender_status')->default(0)->comment('0 = pending, 1 = success, 2 = failed');
            $table->tinyInteger('receiver_status')->default(0)->comment('0 = pending, 1 = accepted , 2 = success');
            $table->tinyInteger('admin_status')->default(0)->comment('0 = pending, 2 = success, 3 = failed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_transfers');
    }
};
