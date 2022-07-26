<?php

namespace App\Calculations;

use App\Models\PaymentMethod;
use App\Models\CurrencyTrades;
use App\Models\FeesSetup;

class CalculateQuoteValues
{

	public static function paymentMethodFeeValue (Array $data)
	{
		return $data["amount"] * $data["payment_method_fee"] / 100;
	}

	public static function conversionFeeValue (Array $data)
	{
		return $data["amount"] * $data["conversion_fee"]  / 100;
	}

	// amount brl - fees payment and conversion quote
	public static function amountConverted(Array $data)
	{
		return ($data["amount"] -
				(self::paymentMethodFeeValue($data) + self::conversionFeeValue($data)))
				/ $data["ask"];
	}

	// amount of destination currency
	public static function amountReceived(Array $data)
	{
		return ($data["amount"] -
				(self::paymentMethodFeeValue($data) + self::conversionFeeValue($data)))
				/ $data["ask"];
	}

}
