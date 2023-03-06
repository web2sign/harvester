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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('harvest_token')->nullable(true);
            $table->text('account_id')->nullable(true);
            $table->string('rate')->nullable(true);
            $table->string('payment_method')->nullable(true);
            $table->text('account_details')->nullable(true);
            $table->text('address')->nullable(true);
            $table->string('invoice_prefix')->nullable(true);
            $table->string('invoice_number')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
