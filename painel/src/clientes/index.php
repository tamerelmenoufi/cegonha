<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");

    vl(['ProjectPainel']);

    if($_POST['delete']){
      $query = "delete from clientes where codigo = '{$_POST['delete']}'";
      mysqli_query($con, $query);
      if(is_file("convites/{$_POST['delete']}.png")) unlink("convites/{$_POST['delete']}.png");

      $query = "delete from clientes_enderecos where cliente = '{$_POST['delete']}'";
      mysqli_query($con, $query);
    }

    if($_POST['situacao']){
      $query = "update clientes set situacao = '{$_POST['opc']}' where codigo = '{$_POST['situacao']}'";
      mysqli_query($con, $query);
      exit();
    }
?>

<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Convidados</h5>
          <div class="card-body">
            <div style="display:flex; justify-content:end">

                <button
                    class="btn btn-warning me-3 enviarConvites"
                >Enviar Convite</button>

                <button
                    novoCadastro
                    class="btn btn-success"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasDireita"
                    role="button"
                    aria-controls="offcanvasDireita"
                >Novo Convite</button>

                <button
                    class="btn btn-primary ms-3 enviarAgradecimento"
                >Enviar Agradecimento</button>
            </div>


            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">
                    <input type="checkbox" class="marcarTudo" />
                  </th>
                  <th scope="col" style="width:100%">Nome</th>
                  <!-- <th scope="col">CPF</th> -->
                  <th scope="col">Telefone</th>
                  <th scope="col">Convidado</th>
                  <!-- <th scope="col" style="width:50%">E-mail</th> -->
                  <!-- <th scope="col">Compras</th> -->
                  <th scope="col">A????es</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "select a.*, (select count(*) from vendas where cliente = a.codigo and situacao != 'n') as vendas from clientes a order by a.nome asc";
                  $result = mysqli_query($con, $query);
                  $p=1;
                  while($d = mysqli_fetch_object($result)){
                ?>
                <tr>
                  <td style="white-space: nowrap;"><?=$p?></td>
                  <td style="white-space: nowrap;">
                    <input type="checkbox" class="marcados" value="<?=$d->codigo?>" />
                  </td>
                  <td style="white-space: nowrap;"><?=$d->nome?></td>
                  <!-- <td style="white-space: nowrap;"><?=$d->cpf?></td> -->
                  <td style="white-space: nowrap;"><?=$d->telefone?></td>
                  <td style="white-space: nowrap;"><?=$d->convidado?></td>
                  <!-- <td style="white-space: nowrap;"><?=$d->email?></td> -->
                  <!-- <td style="white-space: nowrap;"><?=$d->vendas?></td> -->
                  <td style="white-space: nowrap;">

                    <button
                      class="btn btn-primary"
                      convite="<?=$d->codigo?>"
                      nome="<?=$d->nome?>"
                      data-bs-toggle="offcanvas"
                      href="#offcanvasDireita"
                      role="button"
                      aria-controls="offcanvasDireita"
                    >
                      Convite
                    </button>

                    <button
                      class="btn btn-primary"
                      edit="<?=$d->codigo?>"
                      data-bs-toggle="offcanvas"
                      href="#offcanvasDireita"
                      role="button"
                      aria-controls="offcanvasDireita"
                    >
                      Editar
                    </button>
                    <?php
                    // if($d->codigo != 1){
                    ?>
                    <button class="btn btn-danger" <?=(($d->vendas)?'disabled':'delete="'.$d->codigo.'"')?>>
                      Excluir
                    </button>
                    <?php
                    // }
                    ?>
                  </td>
                </tr>
                <?php
                $p++;
                  }
                ?>
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

        $(".enviarConvites").click(function(){

          lista = [];
          $(".marcados").each(function(){
            if($(this).prop("checked") == true){
              lista.push($(this).val());
            }
          });

          if(lista.length){
            console.log(lista)
            $.confirm({
              content:`Deseja realmente enviar os convites para os <b>${lista.length}</b> convidados?`,
              title:"Envio de convites",
              buttons:{
                'SIM':function(){
                  $.ajax({
                    url:"src/clientes/enviar_convite.php",
                    type:"POST",
                    data:{
                      convites:lista
                    },
                    success:function(dados){
                      $.alert(dados);
                    }

                  });
                },
                'N??O':function(){

                }
              }
            })
          }else{
            $.alert('Favor selecione um ou mais contatos para envio dos convites.')
          }

        });

        $(".marcarTudo").click(function(){
          opc = $(this).prop("checked");
          if(opc == true){
            $(".marcados").prop("checked", true);
          }else{
            $(".marcados").prop("checked", false);
          }
        });

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

        $("button[convite]").click(function(){
            cod = $(this).attr("convite");
            $.ajax({
                url:"src/clientes/convite.php",
                type:"POST",
                data:{
                  cod
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        $(".enviarAgradecimento").click(function(){
            // console.log('entrou');
            $.ajax({
                url:"src/clientes/enviar_agradecimento.php",
                success:function(dados){
                  // console.log('concluiu');
                  $.dialog({
                    content:dados,
                    title:"Agradecimentos",
                    columnClass:'col-md-12'
                  });
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
                    'N??O':function(){

                    }
                }
            });

        })



    })
</script>