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
            width:800px;
            height:1120px;
        }
        .corpo img[convite]{
            position:absolute;
            width:800px;
            height:1120px;
            left:0;
            top:0;
        }
        .corpo img[qrcode]
    </style>
</head>
<body>
    <div class="corpo">
        <img convite src="" />
        <img qrcode src="" />
    </div>
</body>
</html>';

$postdata = http_build_query(
    array(
        'html' => base64_encode($html)
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
echo base64_decode($result->doc);