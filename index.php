<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CEGONHA - Bebê Chá</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
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


</head>

<body>

<style>
img-bg-rodape{
  background: url(../img/rodape-bg.jpg) no-repeat ;
}

</style>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body LateralDireita">
    ...
  </div>
</div>

  <!-- ======= Header ======= -->


  <section id="hero-animated" class="hero-animated d-flex align-items-center mt-3">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
        <h2 style="font-size:50px;color:#eee; text-shadow: 2px 2px 5px #000;font-weight: 800"><b>Chá 
          Revelação </b></h2>
        <img src="assets/img/cegonha4.png" class="img-fluid animated">
       
  </section>

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container">
        <div class="section-header">
          <h2>
            <img src="assets/img/presentes/presentes.jpg" style="height:60px; margin-right:20px;" class="img-fluid animated">
            Minha Listinha
          </h2>
          <p>Montei minha lojinha com tudo que vou precisar.<br>É só clicar e comprar <img src="assets/img/presentes/obrigado.png" style="height:50px;" class="img-fluid animated"></p>
        </div>

        <?php

        $p = [

            [
                'nome' => 'Andador',
                'imagem' => 'andador.jpg',
                'estoque' => '1',
                'valor' => '280.00',
            ],
            [
                'nome' => 'Berço',
                'imagem' => 'berco.png',
                'estoque' => '1',
                'valor' => '670.00',
            ],
            [
                'nome' => 'Cadeirinha Refeição',
                'imagem' => 'cadeira_comer.png',
                'estoque' => '1',
                'valor' => '460.00',
            ],
            [
                'nome' => 'Cadeirinha Veículo',
                'imagem' => 'cadeira_veiculo.png',
                'estoque' => '1',
                'valor' => '525.00',
            ],
            [
                'nome' => 'Carrinho Passeio',
                'imagem' => 'carrinho.jpg',
                'estoque' => '1',
                'valor' => '388.00',
            ],
            [
                'nome' => 'Fraudades Descartáveis P',
                'imagem' => 'fraudas.png',
                'estoque' => '10',
                'valor' => '46.98',
            ],
            [
                'nome' => 'Fraudas de Pano',
                'imagem' => 'fraudas_pano.png',
                'estoque' => '20',
                'valor' => '33.00',
            ],
            [
                'nome' => 'Jogo de Lençóis',
                'imagem' => 'lencoes.png',
                'estoque' => '4',
                'valor' => '38.00',
            ],
            [
                'nome' => 'Jogo de Mamadeiras',
                'imagem' => 'mamadeira.png',
                'estoque' => '2',
                'valor' => '86.00',
            ],
            [
                'nome' => 'Ventilador Portátil',
                'imagem' => 'ventilador.jpg',
                'estoque' => '1',
                'valor' => '90.00',
            ],


        ]
        ?>


        <div class="row gy-4">
          <?php
            foreach($p as $i => $v){
          ?>
          <div class="col-xl-3 col-md-6 d-flex" data-aos="zoom-out">
            <div class="service-item position-relative w-100" style="border:solid 2px #eee; border-radius:15px;">
              <h6><a href="" class="stretched-link"><i class="bi bi-gift-fill"></i> <?=$v['nome']?></a></h6>
              <div class="icon justify-content-center align-items-center text-center w-100"
                style="
                        height:250px;
                        background-image:url(assets/img/presentes/<?=$v['imagem']?>);
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
                <button class="btn btn-outline-warning btn-sm" style="border:0"><i class="bi bi-speedometer" style="font-size:30px"></i><br><span style="font-weight:bold"> <?=$v['estoque'].(($v['estoque'] > 1)?' Itens':' Item')?></span></button>
                <button class="btn btn-outline-success btn-sm" style="border:0"><i class="bi bi-bag-heart-fill" style="font-size:30px"></i><br><span style="font-weight:bold">R$ <?=number_format($v['valor'],2,',','.')?></span></button>
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
  <footer id="footer" class="footer img-bg-rodape">



    <div class="footer-legal text-center" style="min-height:80px; background-color:rgb(0,0,0, 0.1); color:#5d5d5d">
      <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center">
        <div>
            <p>Rua 37, Qd 50, Parque Dez, CEP:69000-987</p>
            <p>contato@gmail.com</p>
            <a href="#" class="read-more align-self-start agenda" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><span>Painel de Controle</span> <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>

  </footer><!-- End Footer -->

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
        $("#offcanvasRight").css("width","100%")
    }
    else {
        $("#offcanvasRight").css("width","600px")
    }

</script>
</body>

</html>