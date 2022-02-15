<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Quote;
use App\Models\FeesSetup;
use App\Calculations\CalculateQuoteValues;
use Illuminate\Http\Request;
use App\Http\Requests\QuoteExchangeTradeRequest;

class QuoteController extends Controller
{

    /**
     * view to simulate quote exchance currency
     *
     * @return \Illuminate\View\View
     */
    public function QuoteForm()
    {
        $quoteExchangeTradeAPI = \App::make('App\Services\Contracts\QuoteExchangeTradeInterface');
        $currencies = $quoteExchangeTradeAPI->getAllPossibleConversionsFromCurrency('BRL');
        $payment_methods = PaymentMethod::all();

        return view('quote.form', compact('currencies', 'payment_methods'));
    }

    /**
     * calculate fees and currency trade values
     *
     * @return \Illuminate\View\View
     */
    public function QuoteFormPost(QuoteExchangeTradeRequest $request)
    {

        $paymentMethod = PaymentMethod::find($request->payment_method);
        $feesSetup = FeesSetup::first(); 
        $conversion_fee = $request->amount_brl<=$feesSetup->amount_limit ? $feesSetup->fee_1 : $feesSetup->fee_2;

        $quoteExchangeTradeAPI = \App::make('App\Services\Contracts\QuoteExchangeTradeInterface');
        $currency = $quoteExchangeTradeAPI->getCurrenciesDetails([$request->currency]);

        $data = [
            "amount" => $request->amount_brl,
            "origin_currency" => 'BRL',
            "destination_currency" => $request->currency,
            "ask" => $currency[$request->currency."BRL"]["ask"],
            "bid" => $currency[$request->currency."BRL"]["bid"],
            "user_id" => auth()->user()->id,
            "payment_method_id" => $request->payment_method,
            "payment_method_fee" => $paymentMethod->fees,
            "conversion_fee" => $conversion_fee,
        ];

        $data["amount_converted"] = CalculateQuoteValues::amountConverted($data);     
        $data["amount_received"] = CalculateQuoteValues::amountReceived($data);     

        Quote::create($data);

        $details = [
            'Cliente' => auth()->user()->name,
            'Data da cotação' => date("d/m/Y H:i:s"),
            'Valor em BRL' => number_format($request->amount_brl, 2, ",", "."),
            'Forma de pagamento' => $paymentMethod->title,
            'Moeda a ser comprada' => $request->currency,
            'Cotação da moeda' => "BRL ".number_format($data["ask"], 3, ",", "."),
            'Taxa de pagamento' => "BRL ".
                number_format(($data["payment_method_fee"] * $request->amount_brl / 100)
                , 2, ",", "."),
            'Taxa de conversão' => "BRL ".
                number_format(($data["conversion_fee"] * $request->amount_brl / 100)
                , 2, ",", "."),
            'Valor em moeda estrangeira' => 
                $request->currency . " " . number_format($data["amount_received"], 2, ".", ","),
        ];
       
        try {
            \Mail::to(auth()->user()->email)->send(new \App\Mail\CurrencyTradeEmail($details));
            $message_email = 'Cotação enviada para o email '.auth()->user()->email;
        } catch(\Exception $e) {
            $message_email = 'Problemas ao enviar cotação para o email '.auth()->user()->email;
        }

        if (count(\Mail::failures()) > 0) {
            $message_email = 'Problemas ao enviar cotação para o email '.auth()->user()->email;
        }

        \Session::flash('message', 'Simulação realizada com sucesso. '.$message_email); 

        return view('quote.details', compact('details'));
    }

    public function history()
    {
        $itens = Quote::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('quote.history', compact('itens'));
    }


}
