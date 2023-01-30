<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");
    vl(['ProjectPainel']);
?>

<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Compras Confirmadas</h5>
          <div class="card-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Convidado</th>
                  <!-- <th scope="col">CPF</th> -->
                  <th scope="col">Presente</th>
                  <th scope="col">Valor</th>
                  <th scope="col">Quantidade</th>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "select a.*, b.nome as convidado, c.categoria as nome_categoria, d.produto as nome_produto
                            from vendas_produtos a
                            left join clientes b on a.cliente = b.codigo
                            left join produtos_categorias c on a.categoria = c.codigo
                            left join produtos d on a.produto = d.codigo
                            order by a.venda";
                  $result = mysqli_query($con, $query);
                  $TotalArrecadado = 0;
                  while($d = mysqli_fetch_object($result)){
                ?>
                <tr>
                  <td style="white-space: nowrap;"><?=$d->convidado?></td>
                  <!-- <td style="white-space: nowrap;"><?=$d->cpf?></td> -->
                  <td style="white-space: nowrap;"><?=$d->nome_categoria?><br><?=$d->nome_produto?></td>
                  <td style="white-space: nowrap;">R$ <?=number_format($d->valor_unitario, 2, ',','.')?></td>
                  <td style="white-space: nowrap;"><?=$d->quantidade?></td>
                  <td style="white-space: nowrap;">R$ <?=number_format($d->valor, 2, ',','.')?></td>
                </tr>
                <?php
                $TotalArrecadado = ($TotalArrecadado + $d->valor);
                  }
                ?>
                <tr>
                  <td style="white-space: nowrap; text-align:right; font-weight:bold;" colspan="4">Total Arrecadado</td>
                  <td style="white-space: nowrap; text-align:left; font-weight:bold;">R$ <?=number_format($TotalArrecadado, 2, ',','.')?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<script>
    $(function(){
        Carregando('none');
        $("button[novoCadastro]").click(function(){
            $.ajax({
                url:"src/clientes/form.php",
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        $("button[edit]").click(function(){
            cod = $(this).attr("edit");
            $.ajax({
                url:"src/clientes/form.php",
                type:"POST",
                data:{
                  cod
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })



        $("button[delete]").click(function(){
            deletar = $(this).attr("delete");
            $.confirm({
                content:"Deseja realmente excluir o cadastro ?",
                title:false,
                type:'red',
                buttons:{
                    'SIM':function(){
                        $.ajax({
                            url:"src/clientes/index.php",
                            type:"POST",
                            data:{
                                delete:deletar
                            },
                            success:function(dados){
                              // $.alert(dados);
                              $("#paginaHome").html(dados);
                            }
                        })
                    },
                    'NÃO':function(){

                    }
                }
            });

        })



    })
</script>