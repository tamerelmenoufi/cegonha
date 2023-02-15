<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");



    $query = "select * from vendas where codigo = '{$_SESSION['AppVenda']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

?>
<style>

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

<div class="col" style="margin-bottom:60px;">
    <div class="row">
            <div class="col-12">

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