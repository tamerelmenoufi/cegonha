<?php

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convite</title>
    <style>
        .corpo{
            position:relative;
            width:100%;
            height:1120px;
            border:0;
            padding:0;
        }
        .corpo img[convite]{
            position:absolute;
            width:100%;
            height:auto;
            left:0;
            top:0;
        }
        .corpo img[qrcode]{
            position:absolute;
            width:200px;
            height:200px;
            left:calc(50% - 100px);
            top:925px;
        }
    </style>
</head>
<body>
    <div class="corpo">
        <img convite src="http://project.mohatron.com/cegonha/painel/img/convite.jpg" />
        <img qrcode src="http://project.mohatron.com/cegonha/painel/img/qrcode.png" />
    </div>
</body>
</html>';

$postdata = http_build_query(
    array(
        'html' => base64_encode($html),
        'tipo' => 'img',
    )
);
$opts = array('http' =>
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);
$context = stream_context_create($opts);
$result = file_get_contents('http://html2pdf.mohatron.com/', false, $context);

$result = json_decode($result);
$arq = "convites/{$_POST['cod']}.png"; //md5(date("YmdHis").$result->doc);
$doc = base64_decode($result->doc);
file_put_contents($arq, $doc);
echo "<img src='src/clientes/{$arq}?".date("YmdHis")."' style='width:100%' />";
// unlink($arq);