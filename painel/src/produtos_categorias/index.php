<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    vl(['ProjectPainel']);
?>
<style>

</style>
<div class="p-3">
    <div class="row">
        <div lista class="col-md-12"></div>
    </div>
</div>

<script>
    $(function(){
        Carregando('none');
        $.ajax({
            url:"src/produtos_categorias/lista.php",
            success:function(dados){
                $("div[lista]").html(dados);
            }
        });
    })
</script>