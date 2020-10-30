<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pagon online</title>
    <?php include './incluir/link.php'; ?>
</head>
<body id="container-page-index">
    <?php include './incluir/navbar.php'; ?>
    <div class="jumbotron" id="jumbotron-index">
      <h1><span class="tittles-pages-logo">Shopon-line</span> <small style="color: #fff;">Bolivia</small></h1>
    </div>
    <section id="new-prod-index">
      <div class="container">
        <div class="page-header">
          <h1>Pago mediante Khipu</h1>
        </div>
        <form action="procesos/confirmarPago.php" method="post" role="form" class="FormShpon text-center" data-form="save">
            <h2>Ingrese sus datos</h2>
            <p class="text-center"><input src="https://s3.amazonaws.com/static.khipu.com/buttons/2015/200x75.png" type="image"></input></p>
        </form>
    </section>
    <?php include './incluir/footer.php'; ?>
</body>
</html>