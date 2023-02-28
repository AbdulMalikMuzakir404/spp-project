<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaranDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaction',
        'va_number',
        'transaction_type',
        'transaction_time',
        'transaction_status',
        'transaction_id',
        'store',
        'status_message',
        'status_code',
        'signature_key',
        'settlement_time',
        'permata_va_number',
        'payment_type',
        'order_id',
        'merchant_id',
        'issuer',
        'masked_card',
        'gross_amount',
        'fraud_status',
        'eci',
        'currency',
        'acquirer',
        'channel_response_message',
        'channel_response_code',
        'card_type',
        'bank',
        'approval_code',
        'biller_code',
        'bill_key'
    ];
}
