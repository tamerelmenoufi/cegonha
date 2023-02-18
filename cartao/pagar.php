<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
$_POST = json_decode(file_get_contents('php://input'), true);

file_put_contents('x.txt',print_r($_POST, true)."\n\n\n".date("d/m/Y H:i:s"));

echo $Json = '{
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

exit;
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/payments");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
    \"vehicle\": \"M\",
    \"needReturn\": \"N\",
    \"origin\": {
        \"externalId\": {$id}
    },
    \"destination\": {
        \"type\": \"COORDS\",
        \"address\": {
            \"latitude\": {$lat},
            \"longitude\": {$lng}
        }
    }
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: ".$this->Autenticacao()
));

$response = curl_exec($ch);
curl_close($ch);

return $response;