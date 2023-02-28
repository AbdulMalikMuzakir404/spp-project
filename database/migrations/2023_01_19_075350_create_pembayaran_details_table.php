<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_details', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaction');
            $table->index('kode_transaction');
            $table->foreign('kode_transaction')->references('kode_transaction')->on('pembayarans')->onDelete('cascade');

            $table->string('va_number')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('transaction_time');
            $table->string('transaction_status');
            $table->string('transaction_id');
            $table->string('store')->nullable();
            $table->string('status_message');
            $table->string('status_code');
            $table->string('signature_key');
            $table->string('settlement_time')->nullable();
            $table->string('permata_va_number')->nullable();
            $table->string('payment_type');
            $table->string('order_id');
            $table->string('merchant_id');
            $table->string('issuer')->nullable();
            $table->string('masked_card')->nullable();
            $table->string('gross_amount');
            $table->string('fraud_status');
            $table->string('eci')->nullable();
            $table->string('currency');
            $table->string('acquirer')->nullable();
            $table->string('channel_response_message')->nullable();
            $table->string('channel_response_code')->nullable();
            $table->string('card_type')->nullable();
            $table->string('bank')->nullable();
            $table->string('approval_code')->nullable();
            $table->string('biller_code')->nullable();
            $table->string('bill_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran_details');
    }
};
