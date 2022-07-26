<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\CalculateQuoteValues;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_brl',
        'amount',
        'amount_converted',
        'amount_received',
        'origin_currency',
        'destination_currency',
        'user_id',
        'payment_method_id',
        'payment_method_fee',
        'conversion_fee',
        'ask',
        'bid',
    ];

    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
