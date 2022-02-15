<?php

namespace App\Services\Contracts;

interface QuoteExchangeTradeInterface
{

    /**
     * Create a new QuoteExchangeTradeService instance.
     *
     * @param  \GuzzleHttp\Client
     * @return void
     */
    public function __construct(\GuzzleHttp\Client $client);

    /**
     * consume API endpoints / http client
     *
     * @param  string  $endpoint
     * @return array with content
     */
    public function getData(string $endpoint);

    /**
     * get details of $currencies
     *
     * @param  array $currencies
     * @return array with currencies details
     */
    public function getCurrenciesDetails(Array $currencies);

    /**
     * get all possible currencies conversions
     *
     * @return array with all possible currencies conversions
     */
    public function getAllPossibleConversions();

    /**
     * get all possible currencies conversions from $currency
     *
     * @param  string $currency
     * @return array with all possible currencies conversions for the $currency
     */
    public function getAllPossibleConversionsFromCurrency(String $currency = "BRL");

}