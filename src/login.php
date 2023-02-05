<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
?>
Tela de Login

<button class="btn btn-danger fechar">Fechar</button>

<script>
    $(function(){

        $("fechar").click(function(){
            loginPopup.close();
        });

    })
</script>