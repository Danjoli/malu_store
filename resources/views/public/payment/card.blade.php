@extends('layouts.payment')

@section('title', 'Pagamento com Cartão')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-6">
        Pagamento com Cartão
    </h1>

    <div class="bg-white p-6 rounded-xl shadow">

        <form id="payment-form">

            <div class="mb-4">
                <label class="block mb-1">Número do Cartão</label>
                <input
                    type="text"
                    id="cardNumber"
                    class="w-full border p-3 rounded"
                >
            </div>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1">Validade</label>
                    <input
                        type="text"
                        id="expirationDate"
                        placeholder="MM/YY"
                        class="w-full border p-3 rounded"
                    >
                </div>

                <div>
                    <label class="block mb-1">CVV</label>
                    <input
                        type="text"
                        id="securityCode"
                        class="w-full border p-3 rounded"
                    >
                </div>

            </div>

            <div class="mt-4">
                <label class="block mb-1">Nome no Cartão</label>
                <input
                    type="text"
                    id="cardholderName"
                    class="w-full border p-3 rounded"
                >
            </div>

            <button
                type="submit"
                class="w-full mt-6 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">

                Pagar {{ number_format($order->total,2,',','.') }}

            </button>

        </form>

    </div>

</div>


<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>

const mp = new MercadoPago("{{ env('MP_PUBLIC_KEY') }}");

const form = document.getElementById('payment-form');

form.addEventListener('submit', async function(e){

    e.preventDefault();

    const exp = document.getElementById('expirationDate').value.split('/');

    const cardData = {

        cardNumber: document.getElementById('cardNumber').value,
        expirationMonth: exp[0],
        expirationYear: "20" + exp[1],
        securityCode: document.getElementById('securityCode').value,
        cardholderName: document.getElementById('cardholderName').value

    };

    const token = await mp.createCardToken(cardData);

    fetch("{{ route('payment.card.process', $order->id) }}", {

        method: "POST",

        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },

        body: JSON.stringify({
            token: token.id,
            payment_method_id: token.payment_method_id
        })

    })
    .then(res => res.json())
    .then(data => {

        if(data.success){
            window.location.href = "/order/success";
        }

    });

});

</script>

@endsection
