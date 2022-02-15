<?php

namespace App\Services;
use App\Services\Contracts\QuoteExchangeTradeInterface;

class QuoteExchangeTradeService implements QuoteExchangeTradeInterface
{
    
    /**
     * The active http client to conect to external api
     *
     * @var array
     */
    protected $client;

    /**
     * Create a new QuoteExchangeTradeService instance.
     *
     * @param  \GuzzleHttp\Client
     * @return void
     */
    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    /**
     * consume API endpoints / GuzzleHttp
     *
     * @param  string  $endpoint
     * @return array with content
     */
    public function getData(string $endpoint)
    {
        $response = $this->client->get($endpoint)->getBody();
        return json_decode($response, true);
    }

    /**
     * get details of $currencies
     *
     * @param  array $currencies
     * @return array with currencies details
     */
    public function getCurrenciesDetails(Array $currencies)
    {
        return $this->getData('/json/last/'.implode($currencies, ","));
    }

    /**
     * get all possible currencies conversions
     *
     * @return array with all possible currencies conversions
     */
    public function getAllPossibleConversions()
    {
        return $this->getData('/json/available');
    }

    /**
     * get all possible currencies conversions from $currency
     *
     * @param  string $currency
     * @return array with all possible currencies conversions for the $currency
     */
    public function getAllPossibleConversionsFromCurrency(String $currency = "BRL")
    {
        $possible_currencies_conversions_from_currency = [];
        $all_possible_conversions = array_keys($this->getAllPossibleConversions());

        $all_possible_conversions_to_currency = array_filter($all_possible_conversions, function($value) use ($currency) {
            return strpos($value, $currency."-")!==false;  
        });

        return $this->getCurrenciesDetails($all_possible_conversions_to_currency);
    }

}