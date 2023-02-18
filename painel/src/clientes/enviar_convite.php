<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    include("geraConvite.php");

    $convidados = implode(", ",$_POST['convites']);

    $query = "select * from clientes where codigo in ({$convidados})";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){

    // foreach($_POST['convites'] as $i => $c){

        if(is_file("convites/{$d->codigo}.png")){
            $arq = "convites/{$d->codigo}.png";
        }else{
            $arq = GerarConvite($d->codigo);
        }

        // $arq = GerarConvite($_POST['cod']);

        echo "<img src='src/clientes/".$arq."' /><br>{$d->nome} ({$d->convidado})<hr>";

        $arquivo = "http://project.mohatron.com/cegonha/painel/src/clientes/{$arq}";
        $nome = "convite.png";

        $msg['Papai'] = "Olá, {$d->nome} aqui é o Miguel Oliveira. Estou vivendo um momento bastante especial e dia 25/02/2023, é a data escolhida para o nosso chá revelação. Quero dividir com você essa descoberta. Conto com sua presença!";
        $msg['Mamãe'] = "Olá, {$d->nome} aqui é a Ana Carla. Estou vivendo um momento bastante especial e dia 25/02/23 (sábado), é a data escolhida para meu chá revelação. Quero dividir com você essa descoberta. Conto com sua presença!";

        $mensagem1 = $msg[$d->convidado];
        $mensagem2 = "Acesse a minha lista de presentes no endereço: https://cegonha.project.tec.br/?c=".md5($d->codigo);


     // SendWapp('92991886570', $mensagem1);
        SendWapp(
            $d->telefone,
            [
                'nome' => $nome,
                'arquivo' => $arquivo,
                'mensagem' => $mensagem1
            ],
            'file'
        );
        sleep(2);
        SendWapp($d->telefone, $mensagem2);
        sleep(1);

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


