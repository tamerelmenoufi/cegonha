<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
  mp = new MercadoPago("APP_USR-dc7289b9-3b81-47e0-b705-f935a324b0d7");
</script>

<script>


                    cardForm = mp.cardForm({
                        amount: "5.5",
                        iframe: true,
                        form: {
                            id: "form-checkout",
                            cardNumber: {
                            id: "form-checkout__cardNumber",
                            placeholder: "Número do cartão",
                            },
                            expirationDate: {
                            id: "form-checkout__expirationDate",
                            placeholder: "MM/YY",
                            },
                            securityCode: {
                            id: "form-checkout__securityCode",
                            placeholder: "Código de segurança",
                            },
                            cardholderName: {
                            id: "form-checkout__cardholderName",
                            placeholder: "Titular do cartão",
                            },
                            issuer: {
                            id: "form-checkout__issuer",
                            placeholder: "Banco emissor",
                            },
                            installments: {
                            id: "form-checkout__installments",
                            placeholder: "Parcelas",
                            },
                            identificationType: {
                            id: "form-checkout__identificationType",
                            placeholder: "Tipo de documento",
                            },
                            identificationNumber: {
                            id: "form-checkout__identificationNumber",
                            placeholder: "Número do documento",
                            },
                            cardholderEmail: {
                            id: "form-checkout__cardholderEmail",
                            placeholder: "E-mail",
                            },
                        },
                        callbacks: {
                            onFormMounted: error => {
                            if (error) return console.warn("Form Mounted handling error: ", error);
                            console.log("Form mounted");
                            },
                            onSubmit: event => {
                            event.preventDefault();

                            const {
                                paymentMethodId: payment_method_id,
                                issuerId: issuer_id,
                                cardholderEmail: email,
                                amount,
                                token,
                                installments,
                                identificationNumber,
                                identificationType,
                            } = cardForm.getCardFormData();

                            fetch("/src/pagar_credito_dados.php", {
                                method: "POST",
                                headers: {
                                "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                token,
                                issuer_id,
                                payment_method_id,
                                transaction_amount: Number(amount),
                                installments: Number(installments),
                                description: "Descrição do produto",
                                payer: {
                                    email,
                                    identification: {
                                    type: identificationType,
                                    number: identificationNumber,
                                    },
                                },
                                }),
                            });
                            },
                            onFetching: (resource) => {
                            console.log("Fetching resource: ", resource);
                            // Animate progress bar
                            const progressBar = document.querySelector(".progress-bar");
                            progressBar.removeAttribute("value");

                            return () => {
                                progressBar.setAttribute("value", "0");
                            };
                            }
                        },
                    });


                </script>




                <style>
                    #form-checkout div{
                        height:40px;
                    }
                </style>
                <form id="form-checkout">
                    <div id="form-checkout__cardNumber" class="container"></div>
                    <div id="form-checkout__expirationDate" class="container"></div>
                    <div id="form-checkout__securityCode" class="container"></div>
                    <input type="text" id="form-checkout__cardholderName" value="TAMIR MOHAMED EL ME" />
                    <select id="form-checkout__issuer"></select>
                    <select id="form-checkout__installments"></select>
                    <select id="form-checkout__identificationType"></select>
                    <input type="text" id="form-checkout__identificationNumber" value="00001" />
                    <input type="email" id="form-checkout__cardholderEmail" value="tamer@mohatron.com.br" />

                    <button type="submit" id="form-checkout__submit">Pagar</button>
                    <progress value="0" class="progress-bar">Carregando...</progress>
                </form>



</body>
</html>