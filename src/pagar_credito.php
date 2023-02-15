<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");



    $query = "select * from vendas where codigo = '{$_SESSION['AppVenda']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

?>
<style>
    .PedidoTopoTitulo{
        position:fixed;
        left:0px;
        top:0px;
        width:100%;
        height:60px;
        background:#f5ebdc;
        padding-left:70px;
        padding-top:15px;
        z-index:1;
    }
    .card small{
        font-size:12px;
        text-align:left;
    }
    .card input{
        border:solid 1px #ccc;
        border-radius:3px;
        background-color:#eee;
        color:#333;
        font-size:20px;
        text-align:center;
        margin-bottom:15px;
        width:100%;
        text-transform:uppercase;
    }

    .alertas{
        width:100%;
        text-align:center;
        background-color:#ffffff;
        border:solid 1px #fd3e00;
        color:#ff7d52;
        text-align:center !important;
        border-radius:7px;
        font-size:11px !important;
        font-weight:normal !important;
        padding:5px;
        margin-top:10px;
        margin-bottom:10px;
        display:<?=(($d->tentativas_pagamento < 3)?'block':'none')?>;
    }

</style>
<div class="PedidoTopoTitulo">
    <h4>Pagar <?=$_SESSION['AppPedido']?> com Crédito</h4>
</div>
<div class="col" style="margin-bottom:60px;">
    <div class="row">
            <div class="col-12">

                <script>
                    const mp = new MercadoPago("APP_USR-dc7289b9-3b81-47e0-b705-f935a324b0d7");



                    const cardForm = mp.cardForm({
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

                            fetch("/process_payment", {
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

                </style>
                <form id="form-checkout">
                    <div id="form-checkout__cardNumber" class="container"></div>
                    <div id="form-checkout__expirationDate" class="container"></div>
                    <div id="form-checkout__securityCode" class="container"></div>
                    <input type="text" id="form-checkout__cardholderName" />
                    <select id="form-checkout__issuer"></select>
                    <select id="form-checkout__installments"></select>
                    <select id="form-checkout__identificationType"></select>
                    <input type="text" id="form-checkout__identificationNumber" />
                    <input type="email" id="form-checkout__cardholderEmail" />

                    <button type="submit" id="form-checkout__submit">Pagar</button>
                    <progress value="0" class="progress-bar">Carregando...</progress>
                </form>






            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $("#cartao_numero").mask("9999 9999 9999 9999");
        $("#cartao_validade_mes").mask("99");
        $("#cartao_validade_ano").mask("9999");
        $("#cartao_ccv").mask("9999");

    })
</script>