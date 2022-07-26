<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Simulação de conversão para moeda extrangeira
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('message')" />

                    @if($errors->any())
                    <div class="row">
                        <b style="color: red">{!! implode('', $errors->all('<div>:message</div>')) !!}</b>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('quote_exchange_trade_post') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 col-sm-12 mt-6">
                            <label for="amountBrl">Valor para conversão em BRL</label>
                            <input  id="amountBrl"
                                    class="block mt-1 w-full"
                                    type="number" min="1000.00" max="100000.00" step="0.01"
                                    name="amountBrl" :value="old('amountBrl')"
                                    required autofocus />
                        </div>

                        <div class="col-md-4 col-sm-12 mt-6">
                            <label for="currency">Moeda de destino</label>

                            <select id="currency"
                                    class="block mt-1 w-full"
                                    name="currency" :value="old('destination_currency')"
                                    required autofocus />
                                <option value="">Selecione a moeda desejada</option>
                                @foreach ($currencies as $currency)
                                <option value="{{ $currency["codein"] }}">{{ explode("/", $currency["name"])[1] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-12 mt-6">
                            <label for="paymentMethod">Forma de pagamento</label>

                            <select id="paymentMethod"
                                    class="block mt-1 w-full"
                                    name="paymentMethod" :value="old('paymentMethod')"
                                    required autofocus />
                                <option value="">Informe como deseja realizar o pagamento</option>
                                @foreach ($paymentMethods as $paymentMethod)
                                <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 col-12 mt-6" style="text-align: center">
                        <x-button class="ml-3">
                            Simular conversão
                        </x-button>
                    </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
