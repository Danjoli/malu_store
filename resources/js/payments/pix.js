document.addEventListener('DOMContentLoaded', () => {

    const countdownElement = document.getElementById('countdown');
    const pixCodeElement = document.getElementById('pixCode');
    const copyButton = document.getElementById('copyPixButton');


    /*
    |--------------------------------------------------------------------------
    | Copiar PIX Copia e Cola
    |--------------------------------------------------------------------------
    */

    if (copyButton && pixCodeElement) {

        copyButton.addEventListener('click', async () => {

            try {

                await navigator.clipboard.writeText(
                    pixCodeElement.value
                );


                copyButton.textContent =
                    'PIX copiado!';



                setTimeout(() => {

                    copyButton.textContent =
                        'Copiar código PIX';

                }, 2000);



            } catch (error) {

                console.error(
                    'Erro ao copiar PIX:',
                    error
                );


                alert(
                    'Não foi possível copiar o código PIX.'
                );

            }

        });

    }



    /*
    |--------------------------------------------------------------------------
    | Timer de expiração do PIX
    |--------------------------------------------------------------------------
    */

    const expiresAt = window.PIX_EXPIRES_AT;


    if (countdownElement && expiresAt) {


        const expirationTime =
            Date.parse(expiresAt);



        if (!isNaN(expirationTime)) {


            const updateCountdown = () => {


                const distance =
                    expirationTime - Date.now();



                if (distance <= 0) {


                    countdownElement.textContent =
                        '00:00';



                    clearInterval(
                        countdownInterval
                    );


                    /*
                    Aqui você pode futuramente
                    redirecionar para pagamento expirado
                    */


                    return;

                }



                const minutes = Math.floor(
                    distance / 60000
                );



                const seconds = Math.floor(
                    (distance % 60000) / 1000
                );



                countdownElement.textContent =
                    `${String(minutes).padStart(2, '0')}:` +
                    `${String(seconds).padStart(2, '0')}`;


            };



            // Atualiza imediatamente
            updateCountdown();



            // Atualiza a cada segundo
            const countdownInterval =
                setInterval(
                    updateCountdown,
                    1000
                );



            window.addEventListener(
                'beforeunload',
                () => {

                    clearInterval(
                        countdownInterval
                    );

                }
            );


        } else {

            console.error(
                'PIX_EXPIRES_AT inválido:',
                expiresAt
            );

        }

    }

});
