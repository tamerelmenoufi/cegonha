<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
$_POST = json_decode(file_get_contents('php://input'), true);

$Json = '{
    "transaction_amount": '.$_POST['transaction_amount'].',
    "token": "'.$_POST['token'].'",
    "description": "'.$_POST['description'].'",
    "installments": '.$_POST['installments'].',
    "payment_method_id": "'.$_POST['payment_method_id'].'",
    "issuer_id": '.$_POST['issuer_id'].',
    "payer": {
      "email": "'.$_POST['payer']['email'].'"
    }
}';



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/payments");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, $Json);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer TEST-1171310380547745-050412-ccca37ccd889df8845f6c748fe3d98ec-182791413"
));

$response = curl_exec($ch);
curl_close($ch);

$resposta = json_decode($response);

file_put_contents('x.txt',print_r($_POST, true)."\n\n\n".date("d/m/Y H:i:s")."\n\n\n\n".$Json."\n\n\n\n".$response."\n\n\n\n".print_r($resposta, true));