<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    vl(['ProjectPainel']);
?>

<style>
    .element {
        height:350px;
        overflow:auto;
        width:100%;
        clear:both;
        scrollbar-width: thin;
        scrollbar-color: black transparent;
    }

    .element::-webkit-scrollbar {
        width: 8px;
        height: 5px; /* A altura só é vista quando a rolagem é horizontal */
    }

    .element::-webkit-scrollbar-track {
        background: transparent;
        padding: 2px;
    }

    .element::-webkit-scrollbar-thumb {
        background-color: #ccc;
    }
</style>

<div style="padding:20px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-1 mb-3 element" vendasProducao></div>
        </div>
    </div>
</div>



<script>
    $(function(){

        Carregando('none');



    })
</script>