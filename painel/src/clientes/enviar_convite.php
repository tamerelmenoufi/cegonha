<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    include("geraConvite.php");

    foreach($_POST['convites'] as $i => $c){

        // if(is_file("convites/{$c}.png")){
        //     $arq = "convites/{$c}.png";
        // }else{
        //     $arq = GerarConvite($_POST['cod']);
        // }

        $arq = GerarConvite($_POST['cod']);

        echo "<img src='src/clientes/".$arq."' /><hr>";

    }


