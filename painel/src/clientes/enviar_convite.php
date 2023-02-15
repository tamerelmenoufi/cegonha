<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    include("geraConvite.php");

    foreach($_POST['convites'] as $i => $c){

        if(is_file("convites/{$c}.png")){
            $arq = "convites/{$c}.png";
        }else{
            $arq = GerarConvite($_POST['cod']);
        }

        // $arq = GerarConvite($_POST['cod']);

        echo "<img src='src/clientes/".$arq."' /><hr>";

        $arquivo = "data:image/png;base64,".base64_encode(file_get_contents($arq));
        $nome = "convite.png";

    }

    SendWapp('92991886570', 'Mensagem com confirmação de envio dos convites');
    // SendWapp(
    //         '92991886570',
    //         [
    //             'nome' => $nome,
    //             'arquivo' => $arquivo
    //         ],
    //         'file'
    //     );


