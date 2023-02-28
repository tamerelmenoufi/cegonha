<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");

    $query = "SELECT b.nome, b.telefone FROM vendas a left join clientes b on a.cliente = b.codigo where a.operadora_situacao = 'approved' group by b.codigo order by b.nome";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){

        echo $mensagem = "Oiii, {$d->nome}. Agora sabemos que a mamãe e o papai esperam por mim, o Arthur. Em breve chegarei trazendo muito amor e alegria a eles e a você também. Logo nos reencontraremos para relembrar o momento especial da minha descoberta. Mamãe, Papai e Eu agradecemos sua lembrança, que sabemos, foi de todo o coração. Você é especial para nossa família!! Deus o abençoe, sempre. Com carinho, Ana Carla, Miguel e Arthur.";
        echo "<hr>";
        // sleep(2);
        // SendWapp($d->telefone, $mensagem);
        // sleep(1);

    }

    // SendWapp('92991886570', 'Enviados '.$qt." convite(s) pelo sistema de mensagem.");
    SendWapp('92991886570', $mensagem);
    // SendWapp(
    //         '92991886570',
    //         [
    //             'nome' => $nome,
    //             'arquivo' => $arquivo,
    //             'mensagem' => $mensagem
    //         ],
    //         'file'
    //     );


