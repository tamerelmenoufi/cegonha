<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    include("geraConvite.php");

    foreach($_POST['convites'] as $i => $c){

        if(is_file("convites/{$c}.png")){
            $arq = "convites/{$c}.png";
        }else{
            $arq = GerarConvite($c);
        }

        // $arq = GerarConvite($_POST['cod']);

        echo "<img src='src/clientes/".$arq."' /><hr>";

        $arquivo = "http://project.mohatron.com/cegonha/painel/src/clientes/{$arq}";
        $nome = "convite.png";
        $mensagem = "Acesse a minha lista de presentes no endereço: http://project.mohatron.com/cegonha/?c=".md5($c);

    }

    // SendWapp('92991886570', 'Mensagem com confirmação de envio dos convites');
    // SendWapp(
    //         '92991886570',
    //         [
    //             'nome' => $nome,
    //             'arquivo' => $arquivo,
    //             'mensagem' => $mensagem
    //         ],
    //         'file'
    //     );


