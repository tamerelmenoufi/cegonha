<?php
    session_start();

    include("/appinc/cCegonha.php");
    $md5 = md5(date("YmdHis"));

    $localPainel = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]."/";
    $localSite = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]."/";

    // $localPainel = "http://146.190.52.49:8081/app/cegonha/painel/";
    // $localSite = "http://146.190.52.49:8081/app/cegonha/";


    $localPainel = "https://cegonha.project.tec.br/painel/";
    $localSite = "https://cegonha.project.tec.br/";


    include("/appinc/connect.php");
    $con = AppConnect('cegonha');

    // include("/appinc/connect.php");
    include("fn.php");

    include("vendor/rede/classes.php");
    include("vendor/mercado_pago/classes.php");
    include("vendor/bee/classes.php");
    include("vendor/wapp/send.php");

    if($_GET['convidado']) $_SESSION['convidado'] = $_GET['convidado'];

