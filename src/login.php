<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");

    if($_POST['acao'] == 'login'){
        $query = "select * from clientes where telefone = '{$_POST['telefone']}'";
        $result = mysqli_query($con, $query);
        $d = mysqli_fetch_object($result);
        if($d->codigo){
          echo "success";
          $_SESSION['convidado'] = $d->codigo;
        }else{
          echo "error";
          $_SESSION['convidado'] = false;
        }
        exit();
      }

?>
<!-- Tela de Login

<button class="btn btn-danger fechar">Fechar</button> -->

<div class="mb-3">
    <label for="telefone" class="form-label">Digite o seu número WhatsApp</label>
    <input type="text" class="form-control" id="telefone" aria-describedby="telefonelHelp">
    <div id="telefonelHelp" class="form-text">Para lhe identificar, preciso que informe seu número WhatsApp no campo acima.</div>
</div>
<button type="submit" class="btn btn-primary enviar">Enviar</button>

<script>
    $(function(){
        $("#telefone").mask("(99) 99999-9999");
        $(".enviar").click(function(){
            telefone = $("#telefone").val();
            if(telefone.length == 15){
                $.ajax({
                    url:"src/login.php",
                    type:"POST",
                    data:{
                        telefone,
                        acao:'login'
                    },
                    success:function(dados){
                        if(dados.trim() == 'success'){
                            window.location.href="./?c=<?=md5($d->codigo)?>";
                        }else{
                            $.alert({
                                content:"Ocorreu um erro:<br>Não identificamos o telefone na lista de convidados!",
                                title:"Alerta de Erro",
                            });
                        }
                    }
                });
            }else{
                $.dialog('Número não informado ou incompleto!');
            }
        });
        $(".fechar").click(function(){
            loginPopup.close();
        });

    })
</script>