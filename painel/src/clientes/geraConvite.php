<?php

function GerarConvite($cod){
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Convite</title>
        <style>
            body, .corpo{
                position:relative;
                width:1024px;
                height:1420px;
                border:0;
                padding:0;
                margin:0;
                bottom:0;
                background:transparent;
            }
            .corpo img[convite]{
                position:absolute;
                position:relative;
                width:1024px;
                height:1440px;
                left:0;
                top:0;
                bottom:0;
                margin:0;
                padding:0;
                border:0;
            }
            .corpo img[qrcode]{
                position:absolute;
                width:250px;
                height:250px;
                left:calc(50% - 125px);
                top:895px;
            }
        </style>
    </head>
    <body>
        <div class="corpo">
            <img convite src="http://project.mohatron.com/cegonha/painel/img/convite.jpg" />
            <img qrcode src="http://barcode.mohatron.com/barcode/?f=gif&s=qr&d=http://project.mohatron.com/cegonha/?c='.md5($cod).'&sf=8&ms=s&md=0.9&tc=ffffff" />
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
    $arq = "convites/{$cod}.png"; //md5(date("YmdHis").$result->doc);
    $doc = base64_decode($result->doc);
    file_put_contents($arq, $doc);
    return $arq;
}