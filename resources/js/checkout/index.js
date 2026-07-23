document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('checkout-form');

    // Se não estiver na página de checkout, não executa.
    if (!form) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | DADOS DO CHECKOUT
    |--------------------------------------------------------------------------
    */

    const checkoutData = window.CHECKOUT_DATA ?? {};

    const totalBase = Number(checkoutData.subtotal ?? 0);

    const addresses = checkoutData.addresses ?? [];

    const csrfToken = checkoutData.csrfToken ?? '';


    /*
    |--------------------------------------------------------------------------
    | ELEMENTOS
    |--------------------------------------------------------------------------
    */

    const addressSelect = document.getElementById('address_id');

    const cpfInput = document.getElementById('cpf');

    const btn = document.getElementById('btn-calcular-frete');

    const container = document.getElementById('fretes-container');

    const lista = document.getElementById('lista-fretes');


    /*
    |--------------------------------------------------------------------------
    | FORMATAÇÃO DE VALORES
    |--------------------------------------------------------------------------
    */

    const formatar = (valor) => {

        return Number(valor).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });

    };


    /*
    |--------------------------------------------------------------------------
    | MÁSCARA CPF
    |--------------------------------------------------------------------------
    */

    if (cpfInput) {

        cpfInput.addEventListener('input', function () {

            let v = this.value.replace(/\D/g, '');

            v = v.substring(0, 11);

            v = v.replace(/(\d{3})(\d)/, '$1.$2');

            v = v.replace(/(\d{3})(\d)/, '$1.$2');

            v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            this.value = v;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | SELECIONAR ENDEREÇO SALVO
    |--------------------------------------------------------------------------
    */

    if (addressSelect) {

        addressSelect.addEventListener('change', function () {

            const addressId = this.value;


            /*
            |--------------------------------------------------------------------------
            | NOVO ENDEREÇO
            |--------------------------------------------------------------------------
            */

            if (!addressId) {

                document.getElementById('cep').value = '';

                document.getElementById('recipient_name').value = '';

                document.getElementById('phone').value = '';

                document.getElementById('cpf').value = '';

                document.getElementById('street').value = '';

                document.getElementById('number').value = '';

                document.getElementById('complement').value = '';

                document.getElementById('neighborhood').value = '';

                document.getElementById('city').value = '';

                document.getElementById('state').value = '';

                document.getElementById('label').value = '';

                document.getElementById('is_default').checked = false;

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | BUSCAR ENDEREÇO
            |--------------------------------------------------------------------------
            */

            const address = addresses.find(
                item => String(item.id) === String(addressId)
            );


            if (!address) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | PREENCHER FORMULÁRIO
            |--------------------------------------------------------------------------
            */

            document.getElementById('cep').value =
                address.cep ?? '';

            document.getElementById('recipient_name').value =
                address.recipient_name ?? '';

            document.getElementById('phone').value =
                address.phone ?? '';

            document.getElementById('cpf').value =
                address.cpf ?? '';

            document.getElementById('street').value =
                address.street ?? '';

            document.getElementById('number').value =
                address.number ?? '';

            document.getElementById('complement').value =
                address.complement ?? '';

            document.getElementById('neighborhood').value =
                address.neighborhood ?? '';

            document.getElementById('city').value =
                address.city ?? '';

            document.getElementById('state').value =
                address.state ?? '';

            document.getElementById('label').value =
                address.label ?? '';

            document.getElementById('is_default').checked =
                Boolean(address.is_default);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | CALCULAR FRETE
    |--------------------------------------------------------------------------
    */

    if (btn) {

        btn.addEventListener('click', async () => {

            const cep = document
                .querySelector('input[name="cep"]')
                ?.value
                .replace(/\D/g, '');


            if (!cep || cep.length !== 8) {

                alert('Digite um CEP válido.');

                return;

            }


            btn.innerText = 'Calculando...';

            btn.disabled = true;


            try {

                const { data } = await axios.post(
                    '/frete/calcular',
                    {
                        cep: cep
                    },
                    {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    }
                );


                lista.innerHTML = '';


                if (!Array.isArray(data) || data.length === 0) {

                    alert('Nenhuma opção de frete disponível.');

                    container.classList.add('hidden');

                    return;

                }


                data.forEach(frete => {

                    if (!frete.price) {
                        return;
                    }


                    const div = document.createElement('div');


                    div.classList.add(
                        'frete-card',
                        'border',
                        'p-3',
                        'rounded-lg',
                        'cursor-pointer'
                    );


                    div.innerHTML = `

                        <label class="flex justify-between items-center cursor-pointer">

                            <div>

                                <input
                                    type="radio"
                                    name="frete_opcao"
                                    value="${frete.price}"
                                    data-carrier="${frete.name}"
                                    data-service="${frete.id}"
                                >

                                <strong>
                                    ${frete.name}
                                </strong>

                                <br>

                                <small>
                                    ${frete.delivery_time ?? ''} dias
                                </small>

                            </div>

                            <span>
                                ${formatar(parseFloat(frete.price))}
                            </span>

                        </label>

                    `;


                    lista.appendChild(div);

                });


                container.classList.remove('hidden');

            } catch (error) {

                console.error(
                    error.response?.data || error
                );

                alert('Erro ao calcular frete.');

            } finally {

                btn.innerText = 'Calcular Frete';

                btn.disabled = false;

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | SELECIONAR FRETE
    |--------------------------------------------------------------------------
    */

    document.addEventListener('change', function (event) {

        if (event.target.name !== 'frete_opcao') {
            return;
        }


        const valor = parseFloat(event.target.value);


        document.getElementById('shipping_cost').value =
            valor;


        document.getElementById('carrier').value =
            event.target.dataset.carrier;


        document.getElementById('service').value =
            event.target.dataset.service;


        document.getElementById('valor-frete').innerText =
            formatar(valor);


        document.getElementById('valor-total').innerText =
            formatar(totalBase + valor);


        document
            .querySelectorAll('.frete-card')
            .forEach(card => {

                card.classList.remove(
                    'border-green-500'
                );

            });


        event.target
            .closest('.frete-card')
            ?.classList.add(
                'border-green-500'
            );

    });


    /*
    |--------------------------------------------------------------------------
    | VALIDAÇÃO ANTES DE FINALIZAR
    |--------------------------------------------------------------------------
    */

    form.addEventListener('submit', function (event) {

        const shipping =
            document.getElementById('shipping_cost').value;


        if (!shipping) {

            event.preventDefault();

            alert(
                'Selecione um frete antes de finalizar.'
            );

        }

    });

});
