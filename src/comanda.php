<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");

    if($_SESSION['convidado']){
        $query = "select a.*,
            (select codigo from vendas where cliente = a.codigo and situacao = 'n' and deletado != '1') as venda
        from clientes a where a.codigo = '{$_SESSION['convidado']}'";
        $result = mysqli_query($con, $query);
        $d = mysqli_fetch_object($result);

        if(!$d->venda){
            $q = "insert into vendas set cliente = '{$d->codigo}', situacao = 'n'";
            mysqli_query($con, $q);
            $_SESSION['codVenda'] = mysqli_insert_id($con);

        }else{
            $_SESSION['codVenda'] = $d->venda;
        }
    }


    if($_POST['acao'] == 'excluir'){
        mysqli_query($con, "delete from vendas_produtos where codigo = '{$_POST['codigo']}'");
        mysqli_query($con, "delete from vendas_pagamentos where venda = '{$_SESSION['codVenda']}'");
    }

    if($_POST['acao'] == 'atualizar'){

        $query = "update vendas_produtos set quantidade = '{$_POST['quantidade']}', valor=(valor_unitario*".$_POST['quantidade'].") where codigo = '{$_POST['codigo']}'";
        mysqli_query($con, $query);
        mysqli_query($con, "delete from vendas_pagamentos where venda = '{$_SESSION['codVenda']}'");
    }


    if($_POST['codProduto']){

        $p = mysqli_fetch_object(mysqli_query($con, "select * from produtos where codigo = '{$_POST['codProduto']}'"));
        $qt = (($_POST['quantidade']?:1));
        $query = "insert into vendas_produtos set
                        venda = '{$_SESSION['codVenda']}',
                        cliente = '{$_SESSION['convidado']}',
                        colaborador = '',

                        produto_tipo = '{$p->tipo}',
                        categoria = '{$p->categoria}',
                        produto = '{$p->codigo}',
                        valor_unitario = '{$p->valor}',
                        quantidade = '{$qt}',
                        valor = '".($qt*$p->valor)."',

                        comissao_tipo = '',
                        comissao_valor = '',
                        comissao = '',

                        total = '".($qt*$p->valor)."',
                        situacao = 'n',
                        data_pedido = ''
        ";
        $result = mysqli_query($con,$query);
        mysqli_query($con, "delete from vendas_pagamentos where venda = '{$_SESSION['codVenda']}'");

    }



    if($_POST['acao'] == 'forma_pagamento'){
        $query = "insert into vendas_pagamentos set
                                venda = '{$_SESSION['codVenda']}',
                                forma_pagamento = '{$_POST['forma_pagamento']}',
                                valor = '{$_POST['valor']}'";
        mysqli_query($con, $query);
    }

    if($_POST['acao'] == 'pagamento_del'){
        $query = "delete from vendas_pagamentos where codigo = '{$_POST['codigo']}' ";
        mysqli_query($con, $query);
    }

?>
<style>
    .Titulo<?=$md5?>{
        position:absolute;
        left:60px;
        top:8px;
        z-index:0;
    }
</style>

<h4 class="Titulo<?=$md5?>"><i class="fa-solid fa-receipt"></i> Comanda da compra</h4>
<div class="p-3" style="font-size:12px;">
    <div class="row justify-content-between" style="margin-bottom:10px;">
    <div class="col-3">
        <b>Descri????o</b>
    </div>
    <div class="col-3">
        <b>Vl Uni</b>
    </div>
    <div class="col-3">
        <b>Quant.</b>
    </div>
    <div class="col-3">
        <b>Vl Tot</b>
    </div>
    </div>

    <?php
        $query = "select
                                a.*,
                                p.tipo,
                                p.codigo as cod_produto,
                                p.produto as produto_nome,
                                p.estoque,
                                if(p.tipo = 'p', 'Produto', 'Servi??o') as tipo_nome,
                                c.categoria as categoria_nome
                            from vendas_produtos a
                                left join produtos p on a.produto = p.codigo
                                left join produtos_categorias c on p.categoria = c.codigo
                            where a.venda = '{$_SESSION['codVenda']}'";
                $result = mysqli_query($con, $query);
                $n = mysqli_num_rows($result);
                $tipo_produtos = false;
                $total = 0;
                $QtProd = 0;
                while($d = mysqli_fetch_object($result)){
                    if($d->tipo == 'p') $tipo_produtos = true;
    ?>


    <div class="row justify-content-between">
        <div class="col-1">
            <i class="bi bi-trash3 excluirItem" style="cursor:pointer; color:red; font-weight:bold;" codigo="<?=$d->codigo?>" produto="<?=$d->produto_nome?>" cod_produto="<?=$d->produto?>" ></i>
        </div>
        <div class="col-11">
            <?=$d->produto_nome?><br><small><?=$d->categoria_nome?> (<?=$d->tipo_nome?>)</small>
        </div>
    </div>

    <div class="row justify-content-between" style="margin-bottom:20px;">

        <div class="col-3">

        </div>
        <div class="col-3">
            R$ <?=number_format($d->valor_unitario,2,',','.')?>
        </div>
        <div class="col-3">
        <select class="form-select form-select-sm atualizar" produto="<?=$d->codigo?>" aria-label=".form-select-sm example">
            <?php
            for($i=1;$i<=$d->estoque;$i++){
            ?>
            <option value="<?=$i?>" <?=(($d->quantidade == $i)?'selected':false)?>><?=$i?></option>
            <?php
            }
            ?>
        </select>
        </div>
        <div class="col-3">
            R$ <?=number_format($d->valor,2,',','.')?>
        </div>
    </div>

    <?php
            $total = ($total + $d->valor);
            $QtProd = ($QtProd + $d->quantidade);
                }


    mysqli_query($con, "update vendas set valor='{$total}', total = '{$total}' where codigo = '{$_SESSION['codVenda']}'");

    ?>

    <div class="row justify-content-between">
        <div class="col-9 text-end">
            <b>TOTAL</b>
        </div>

        <div class="col-3">
            <b>R$ <?=number_format($total,2,',','.')?></b>
        </div>
    </div>

    <div class="row" style="margin-top:30px; margin-bottom:30px;">
        <div class="col-2"></div>
        <div class="col-8">
            <button class="btn btn-lg btn-success w-100 compras"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasDireita"
                    role="button"
                    aria-controls="offcanvasDireita">
                Voltar ??s compras
            </button>
        </div>
    </div>

    <div class="row" style="margin-top:30px; margin-bottom:5px;">
        <div class="col-12 text-center">Selecione abaixo uma forma de pagamento</div>
    </div>

    <div class="row" style="margin-top:5px; margin-bottom:30px;">
        <div class="col-2"></div>
        <div class="col-4">
            <button class="btn btn-lg btn-primary w-100 credito">
                <i class="bi bi-credit-card-2-front-fill" style="font-size:40px; font-weight:bold"></i>
                <br>
                Cr??dito
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-lg btn-primary w-100 pix">
                <i class="bi bi-qr-code-scan" style="font-size:40px; font-weight:bold"></i>
                <br>
                PIX
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 forma_pagamento">

        </div>
    </div>




</div>



<script>
    $(function(){

        <?php
        if($QtProd){
        ?>
        $(".QtProd").html("<?=$QtProd?>");
        <?php
        }else{
        ?>
        $("button[comanda]").css("opacity","0");
        window.location.href="./?c=<?=md5($_SESSION['convidado'])?>";
        <?php
        }
        ?>



        $(".atualizar").change(function(){

            codigo = $(this).attr("produto");
            quantidade = $(this).val();
            $.ajax({
                url:"src/comanda.php?convidado=<?=$_SESSION['convidado']?>",
                type:"POST",
                data:{
                    codigo,
                    quantidade,
                    acao:'atualizar'
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            });

        });

        $(".excluirItem").click(function(){
            codigo = $(this).attr("codigo");
            cod_produto = $(this).attr("cod_produto");
            produto = $(this).attr("produto");

            $.confirm({
                content:`Deseja realmente excluir o <b>${produto}</b>?`,
                title:"Alerta!",
                buttons:{
                    'SIM':function(){
                        $.ajax({
                            url:"src/comanda.php?convidado=<?=$_SESSION['convidado']?>",
                            type:"POST",
                            data:{
                                codigo,
                                produto,
                                acao:'excluir'
                            },
                            success:function(dados){
                                $(".LateralDireita").html(dados);
                                $(`div[blq${cod_produto}]`).css("display","none");
                            }
                        });
                    },
                    'N??O':function(){

                    }
                }
            });

        });


        $(".pix").click(function(){
            $.ajax({
                url:"src/pagar_pix.php",
                success:function(dados){
                    $(".forma_pagamento").html(dados);
                }
            });
        })


        $(".credito").click(function(){

            $.ajax({
                url:"src/pagar_credito.php",
                success:function(dados){
                    $(".forma_pagamento").html(dados);
                }
            });


        })


        $(".compras").click(function(){
            $(".LateralDireita").html('');
        })



    })
</script>