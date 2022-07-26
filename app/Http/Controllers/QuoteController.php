<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Quote;
use App\Models\FeesSetup;
use App\Calculations\CalculateQuoteValues;
use Illuminate\Http\Request;
use App\Http\Requests\QuoteExchangeTradeRequest;
use App\Repositories\Contracts\QuoteRepositoryInterface;

class QuoteController extends Controller
{
    private $quoteExchangeTradeAPI;

    public function __construct()
    {
        $this->quoteExchangeTradeAPI = \App::make('App\Services\Contracts\QuoteExchangeTradeInterface');
    }

    /**
     * form to simulate quote exchance currency
     *
     * @return \Illuminate\View\View
     */
    public function QuoteForm()
    {
        $currencies = $this->quoteExchangeTradeAPI->getAllPossibleConversionsFromCurrency('BRL');
        $paymentMethods = PaymentMethod::all();
        return view('quote.form', compact('currencies', 'paymentMethods'));
    }

    /**
     * calculate fees and currency trade values
     *
     * @return \Illuminate\View\View
     */
    public function QuoteFormPost(QuoteExchangeTradeRequest $request, QuoteRepositoryInterface $QuoteRepo)
    {
        $quote = $QuoteRepo->create($request);
        // criar observer, para o model Quotes, disparando email no create
        return redirect()->route('history');
    }

    public function history()
    {
        $itens = Quote::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return view('quote.history', compact('itens'));
    }


}
