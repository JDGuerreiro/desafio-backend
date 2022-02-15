<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Resultado da Simulação de conversão para moeda extrangeira
            <small>Este resultado foi enviado para o seu email</small>
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

					<h1>RESULTADO DA SIMULAÇÃO</h1>
					</br>
					@foreach ($details as $field => $value)
						<p><b>{{ $field}}:</b> {{$value}}</p>
					@endforeach



                </div>
            </div>
        </div>
    </div>
</x-app-layout>



