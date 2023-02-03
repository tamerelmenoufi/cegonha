<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");


    $_SESSION['convidado'] = '8';


    if($_SESSION['convidado']){
      $query = "select a.*,
          (select codigo from vendas where cliente = a.codigo and situacao = 'n' and deletado != '1') as venda
      from clientes a where a.codigo = '{$_SESSION['convidado']}'";
      $result = mysqli_query($con, $query);
      $d = mysqli_fetch_object($result);

      if(!$d->venda){
          mysqli_query($con, "insert into vendas set cliente = '{$d->codigo}', situacao = 'n'");
          $_SESSION['codVenda'] = mysqli_insert_id($con);

      }else{
          $_SESSION['codVenda'] = $d->venda;
      }

      $query = "select
                                a.*,
                                p.tipo,
                                p.codigo as cod_produto,
                                p.produto as produto_nome,
                                p.estoque,
                                if(p.tipo = 'p', 'Produto', 'Serviço') as tipo_nome,
                                c.categoria as categoria_nome
                            from vendas_produtos a
                                left join produtos p on a.produto = p.codigo
                                left join produtos_categorias c on p.categoria = c.codigo
                            where a.venda = '{$_SESSION['codVenda']}'";
        $result = mysqli_query($con, $query);
        $blq = [];
        while($d = mysqli_fetch_object($result)){
          $blq[] = $d->produto;
        }
    }


?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CEGONHA - Bebê Chá</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logofavicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <!-- <link href="assets/css/variables-blue.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-green.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-orange.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-purple.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-red.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/variables-pink.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: HeroBiz - v2.1.0
  * Template URL: https://bootstrapmade.com/herobiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <script src="painel/lib/vendor/jquery-3.6.0/jquery-3.6.0.min.js" ></script>

  <link href="<?=$localPainel?>lib/vendor/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css" rel="stylesheet" >
  <script src="<?=$localPainel?>lib/vendor/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js" ></script>


    <style>
      .bloq{
        position:absolute;
        left:0;
        top:0;
        right:0;
        bottom:0;
        z-index: 8;
        background:#fff;
        opacity: 0.7;
      }
    </style>

</head>

<body>


<button
        comanda
        class="btn btn-primary"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight"
        style="position:fixed; top:10px; right:10px; z-index:9; font-weight:bold; opacity:<?=((count($blq))?'0.7':'0')?>;">
  <span class="QtProd"><?=count($blq)?></span> <i class="bi bi-cart"></i><br>
  Compras
</button>



<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body LateralDireita"></div>
</div>

  <!-- ======= Header ======= -->


  <section id="hero-animated" class="hero-animated d-flex align-items-center mt-3">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
        <h2 style="font-size:50px;color:#eee; text-shadow: 2px 2px 5px #000;font-weight: 800"><b>Chá
          Revelação </b></h2>

       <div class="d-none d-sm-block">
          <img src="assets/img/cegonha4.png" class="img-fluid animated">
</div>

  <div class="d-block d-sm-none" >
          <img style="margin-bottom:0px" src="assets/img/cegonhaverde.png" class="img-fluid animated">
          <img style="height:75px;margin-bottom:0px;margin-top:0px" src="assets/img/cegonhainter.png" class="img-fluid animated">
          <img src="assets/img/cegonharoxa.png" class="img-fluid animated">

</div>


  </section>

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section style="padding:0px" id="featured-services" class="featured-services">
      <div class="container">
        <div class="section-header">
          <h2 style="margin-bottom:0px;font-weight:bold;text-shadow: 1px 1px 5px #fff;color: #6e6e6e;" style=" margin-bottom:0px;">
            Minha Listinha
          </h2>

<img src="assets/img/titulolista.png" style="height:100px; margin-right:0px;" class="img-fluid animated">

<p style="margin-bottom:0px;font-weight:bold;text-shadow: 1px 1px 5px #fff;color: #6e6e6e;">Montei minha lojinha com tudo que vou precisar.<br>É só clicar e comprar </p>
        </div>

        <?php

        $query = "select * from produtos order by categoria";
        $result = mysqli_query($con, $query);

        ?>


        <div class="row gy-4">
          <?php
            // foreach($p as $i => $v){
            while($d = mysqli_fetch_object($result)){

          ?>
          <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
            <div class="service-item position-relative w-100" style="border:solid 2px #eee; border-radius:15px;">
              <div blq<?=$d->codigo?> class="bloq" style="<?=((!@in_array($d->codigo,$blq))?"display:none;":"display:inline;")?>"></div>
              <h6><a
                    href="#XXX"
                    class="stretched-link"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"
                    produto="<?=$d->codigo?>"
                  ><i class="bi bi-gift-fill"></i> <?=$d->produto?></a></h6>
              <div class="icon justify-content-center align-items-center text-center w-100"
                style="
                        height:250px;
                        background-image:url(<?=$localPainel?>src/volume/produtos/<?=$d->imagem?>);
                        background-size:contain;
                        background-position: center;
                        background-repeat:no-repeat;
                        border-radius:15px;
                    "
              >
                <!-- <img src="assets/img/presentes/<?=$v['imagem']?>" class="img-fluid"> -->
                <!-- <i class="bi bi-activity icon"></i> -->
              </div>
              <div class="d-flex flex-row justify-content-between position-relative">
                <button class="btn btn-outline-warning btn-sm" style="border:0">Preciso de<br><i class="bi bi-speedometer" style="font-size:30px"></i><br><span style="font-weight:bold"> <?=$d->estoque.(($d->estoque > 1)?' Itens':' Item')?></span></button>
                <button class="btn btn-outline-success btn-sm" style="border:0">Comprar<br><i class="bi bi-bag-heart-fill" style="font-size:30px"></i><br><span style="font-weight:bold">R$ <?=number_format($d->valor,2,',','.')?></span><span style="font-size:9px">/Item</span></button>
              </div>
            </div>
          </div><!-- End Service Item -->
          <?php
            }
          ?>


        </div>

      </div>
    </section><!-- End Featured Services Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 <br>

 <div class=" img-bg-rodape d-none d-sm-block">
  <footer id="footer" class="footer ">
    <div class="footer-legal text-center" style="min-height:80px; background-color:rgb(0,0,0, 0.1); color:#5d5d5d">
      <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center">
        <div>

            <a href="#" class="read-more align-self-start informacoes"
             type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
              <img src="assets/img/botaoinforma.png" style="height:75px; margin-right:0px;"  class="img-fluid animated">


            </a>

        </div>
      </div>
    </div>

  </footer>
 </div>

<div class=" img-bg-rodape-celular d-block d-sm-none">
  <footer id="footer" class="footer">
    <div class="footer-legal text-center" style="min-height:80px; background-color:rgb(0,0,0, 0.1); color:#5d5d5d">
      <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center">
        <div>
        <a href="#XXX" class="read-more align-self-start informacoes"
             type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
              <img src="assets/img/botaoinforma.png" style="height:75px; margin-right:0px;"  class="img-fluid animated">


            </a>
        </div>
      </div>
    </div>

  </footer>
          </div>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<script>



    if( navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
    ){
        $("#offcanvasRight").css("width","100%");
    }
    else {
        $("#offcanvasRight").css("width","600px");
    }

  $(function(){

    $(".informacoes").click(function(){
      $(".LateralDireita").html('');
      $.ajax({
        url:"src/endereco.php",
        success:function(dados){
          $(".LateralDireita").html(dados);
        },
        error:function(){
          alert('erro')
        }
      })
    })


      $("a[produto]").click(function(){
        produto = $(this).attr("produto");
        $(".LateralDireita").html('');
        $.ajax({
          url:"src/comanda.php",
          type:"POST",
          data:{
            codProduto:produto,
          },
          success:function(dados){
            $(".LateralDireita").html(dados);
            $(`div[blq${produto}]`).css("display","inline");
            $("button[comanda]").css("opacity":"0.7");
          },
          error:function(){
            alert('erro')
          }
        })
      })

      $("button[comanda]").click(function(){
        $(".LateralDireita").html('');
        $.ajax({
          url:"src/comanda.php",
          success:function(dados){
            $(".LateralDireita").html(dados);
          },
          error:function(){
            alert('erro')
          }
        })
      })

    })


</script>
</body>

</html>