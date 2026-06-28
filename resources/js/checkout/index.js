document.addEventListener('DOMContentLoaded', () => {

    const formatar = (v) => {
        return v.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    };

    const cpfInput = document.getElementById('cpf');

    if (cpfInput) {
        cpfInput.addEventListener('input', function () {
            let v = this.value.replace(/\D/g, '');

            v = v.replace(/(\d{3})(\d)/, '$1.$2');
            v = v.replace(/(\d{3})(\d)/, '$1.$2');
            v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            this.value = v;
        });
    }

    const totalBase = window.SUBTOTAL ?? 0;

    const btn = document.getElementById('btn-calcular-frete');
    const container = document.getElementById('fretes-container');
    const lista = document.getElementById('lista-fretes');

    if (btn) {
        btn.addEventListener('click', async () => {

            const cep = document.querySelector('input[name="cep"]')?.value;

            if (!cep || cep.length < 8) {
                alert('Digite um CEP válido');
                return;
            }

            btn.innerText = 'Calculando...';
            btn.disabled = true;

            try {
                const { data } = await axios.post('/frete/calcular', {
                    cep
                }, {
                    headers: {
                        'X-CSRF-TOKEN': window.CSRF_TOKEN
                    }
                });

                if (!lista || !container) {
                    console.error('Elementos do DOM não encontrados');
                    return;
                }

                lista.innerHTML = '';

                if (!Array.isArray(data)) {
                    alert('Erro ao calcular frete');
                    return;
                }

                data.forEach(frete => {
                    if (!frete.price) return;

                    const div = document.createElement('div');
                    div.classList.add('border', 'p-3', 'rounded-lg', 'cursor-pointer');

                    div.innerHTML = `
                        <label class="flex justify-between items-center">
                            <div>
                                <input type="radio" name="frete_opcao"
                                    value="${frete.price}"
                                    data-carrier="${frete.name}"
                                    data-service="${frete.id}">
                                <strong>${frete.name}</strong><br>
                                <small>${frete.delivery_time} dias</small>
                            </div>
                            <span>${formatar(parseFloat(frete.price))}</span>
                        </label>
                    `;

                    lista.appendChild(div);
                });

                container.classList.remove('hidden');

            } catch (error) {
                console.error(error.response?.data || error);
                alert('Erro ao calcular frete');
            }

            btn.innerText = 'Calcular Frete';
            btn.disabled = false;
        });
    }

    document.addEventListener('change', function (e) {

        if (e.target.name === 'frete_opcao') {

            const valor = parseFloat(e.target.value);
            const carrier = e.target.dataset.carrier;
            const service = e.target.dataset.service;

            document.getElementById('shipping_cost').value = valor;
            document.getElementById('carrier').value = carrier;
            document.getElementById('service').value = service;

            document.getElementById('valor-frete').innerText = formatar(valor);

            const total = totalBase + valor;
            document.getElementById('valor-total').innerText = formatar(total);

            document.querySelectorAll('#lista-fretes > div').forEach(el => {
                el.classList.remove('border-green-500');
            });

            e.target.closest('div').classList.add('border-green-500');
        }
    });

    document.querySelector('form')?.addEventListener('submit', function (e) {

        const shipping = document.getElementById('shipping_cost')?.value;

        if (!shipping) {
            e.preventDefault();
            alert('Selecione um frete antes de finalizar.');
        }
    });

});
