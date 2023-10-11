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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('trans_id');
            $table->string('domain');
            $table->string('status');
            $table->string('reference');
            $table->integer('amount');
            $table->text('message')->nullable();
            $table->string('gateway_response');
            $table->dateTime('paid_at')->nullable();
            $table->string('channel');
            $table->string('currency');
            $table->string('ip_address')->nullable();
            $table->decimal('fees');
            $table->text('prev_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
