<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\PaymentMethod;

class CreateTableQuotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('amount');
            $table->unsignedDecimal('amount_received');
            $table->unsignedDecimal('amount_converted');
            $table->string('origin_currency');
            $table->string('destination_currency');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(PaymentMethod::class);
            $table->unsignedDecimal('payment_method_fee');
            $table->unsignedDecimal('conversion_fee');
            $table->unsignedDecimal('bid')->nullable();
            $table->unsignedDecimal('ask')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
