<?php

include("geraConvite.php");

if(is_file("convites/{$_POST['cod']}.png")){
    $arq = "convites/{$_POST['cod']}.png";
}else{
    $arq = GerarConvite($_POST['cod']);
}


echo "<img src='src/clientes/{$arq}' style='width:100%' />";
// unlink($arq);