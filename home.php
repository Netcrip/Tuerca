<!DOCTYPE html>
<html>
<head>
    <?php include("head.php") ?>
    <title>La Tuerca</title>
</head>
<body class="bcolor">
    <div class="fixed-top">
    <?php include("nav.php") ?>
    </div>
    <?php include("header.php") ?>

    <!--ofertas -->
    <div class="ofertas d-none d-lg-block"><h5>Ofertas</h5></div>
    <div class="d-none d-lg-block">
    <?php include("ofertas.php") ?>
    </div>
    <a href="#" data-toggle="collapse" data-target="#oferta" class="ofertas d-block d-lg-none">Ofertas</a>
    <div id="oferta" class="collapse">
    <?php include("ofertas.php") ?>
    </div> 
    <!-- footer-->
    <div class="imcolor">
    <img class="float-right img-fluid img-thumbnail b" src="img/data.png" alt="">
    </div>
    <?php include("footer.php")?>
</body>
</html>