<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertPaymentMethods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Insert some stuff
        DB::table('payment_methods')->insert(
            [
                ['title' => 'Boleto bancário', 'fees' => 1.45],
                ['title' => 'Cartão de crédito', 'fees' => 7.63],
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
