<?php

namespace App\Repositories;

use App\Models\Quote;

use App\Repositories\Contracts\QuoteRepositoryInterface;
use App\Models\{PaymentMethod, FeesSetup};
use App\Calculations\CalculateQuoteValues;

class QuoteRepository implements QuoteRepositoryInterface
{
    private $quote;

    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    public function create($data)
    {
        $quoteExchangeTradeAPI = \App::make('App\Services\Contracts\QuoteExchangeTradeInterface');

        $paymentMethod = PaymentMethod::find($data->paymentMethod);
        $feesSetup = FeesSetup::first();
        $conversionFee = $data->amountBrl<=$feesSetup->amount_limit ? $feesSetup->fee_1 : $feesSetup->fee_2;
        $currency = $quoteExchangeTradeAPI->getCurrenciesDetails([$data->currency]);

        $fields = [
            "amount" => $data->amountBrl,
            "origin_currency" => 'BRL',
            "destination_currency" => $data->currency,
            "ask" => $currency[$data->currency."BRL"]["ask"],
            "bid" => $currency[$data->currency."BRL"]["bid"],
            "user_id" => auth()->user()->id,
            "payment_method_id" => $data->paymentMethod,
            "payment_method_fee" => $paymentMethod->fees,
            "conversion_fee" => $conversionFee,
        ];

        $fields["amount_converted"] = CalculateQuoteValues::amountConverted($fields);
        $fields["amount_received"] = CalculateQuoteValues::amountReceived($fields);

        return $this->quote->create($fields);

    }

}
