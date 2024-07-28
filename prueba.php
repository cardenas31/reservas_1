<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adventure Wordl</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>


<body>

  <header>

    <nav class="navbar navbar-expand-lg bg-danger">

      <div class="container-fluid mb-2">
        <a class="navbar-brand fw-bold text-warning " href="#">AdventureWorld</a>
        <button class="navbar-toggler text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav  me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Destinos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white " href="#">Ofertas Especiales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white " href="#">Quienes Somos</a>
            </li>
          </ul>
          <div class="redes">
            <a href="https://web.whatsapp.com/"><i class="bi bi-whatsapp text-warning"></i></a>
            <a href="https://www.gmail.com/"><i class="bi bi-envelope text-warning"></i></a>

          </div>

        </div>
    </nav>


  </header>

  <main>
    <section class="search container-fluid">
      <div class=" container p-5 mb-2">
        <div class="row my-5 ">
          <div class="destiny-form ">
            <form class=" " action="prueba.php" method="get">
              <h1 class="text-center mt-2 mb-4  display-6 fw-semibold">Busca tu Destino</h1>
              <div class="container">

                <div class="form-group col-md-3">
                  
                <div>
                  <label>País</label>
                  <?php
                  $con = mysqli_connect("localhost", "root", "", "agencia_viajes");
                  $ciudad = '';
                  $query = "SELECT pais FROM destinos GROUP BY pais ORDER BY pais ASC";
                  $result = mysqli_query($con, $query);
                  while ($row = mysqli_fetch_array($result)) {
                    $ciudad .= '<option value="' . $row["pais"] . '">' . $row["pais"] . '</option>';
                  }
                  ?>
                  <select name="pais" id="pais" class="custom-select" required>
                    <option value="">--Select Ciudad--</option>
                    <?php echo $ciudad; ?>
                  </select>
                  </div>



                  <div>
                  <label>Ciudad</label>
                  <?php
                  $con = mysqli_connect("localhost", "root", "", "agencia_viajes");
                  $ciudad = '';
                  $query = "SELECT ciudad FROM destinos GROUP BY ciudad ORDER BY ciudad ASC";
                  $result = mysqli_query($con, $query);
                  while ($row = mysqli_fetch_array($result)) {
                    $ciudad .= '<option value="' . $row["ciudad"] . '">' . $row["ciudad"] . '</option>';
                  }
                  ?>
                  <select name="city" id="ciudad" class="custom-select" required>
                    <option value="">--Select Ciudad--</option>
                    <?php echo $ciudad; ?>
                  </select>
                  </div>

                  <div class="form-group">
                  <label>Nombre Hotel</label>
                  <?php
                  $con = mysqli_connect("localhost", "root", "", "agencia_viajes");
                  $ciudad = '';
                  $query = "SELECT nombre_hotel FROM destinos GROUP BY nombre_hotel ORDER BY nombre_hotel ASC";
                  $result = mysqli_query($con, $query);
                  while ($row = mysqli_fetch_array($result)) {
                    $ciudad .= '<option value="' . $row["nombre_hotel"] . '">' . $row["nombre_hotel"] . '</option>';
                  }
                  ?>
                  <select name="nombre_hotel" id="nombre_hotel" class="custom-select" required>
                    <option value="">--Select Ciudad--</option>
                    <?php echo $ciudad; ?>
                  </select>
                  </div>
                  

                  <div class="form-group mb-2 mt-4">
                    <button class="btn btn-primary form-control " type="submit" value="Buscar" name="buscar">Buscar</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>



    <div align="center" class="container mt-5">
      <h5 align="center">Informe de resumen de ventas de productos por fecha de ventas y filtro de productos</h5><br>
      <h6 align="center">Rango de fechas de búsqueda dentro de: (1 de enero de 2021 al 31 de diciembre de 2021/fecha actual)</h6><br>
      <form class="myForm" method="get" enctype="application/x-www-form-urlencoded" action="index.php">
        <div class="form-row" align="left">
          <div class="form-group col-md-3">
            <label>Partir de la fecha:</label>
            <input type="date" class="datepicker btn-block" name="from" id="fromDate" Placeholder="Select From Date" value="<?php echo isset($_GET['from']) ? $_GET['from'] : '' ?>">
          </div>
          <div class="form-group col-md-3">
            <label>Hasta la fecha: </label>
            <input type="date" name="to" id="toDate" class="datepicker btn-block" Placeholder="Select To Date" value="<?php echo isset($_GET['to']) ? $_GET['to'] : '' ?>">
          </div>
          <div class="form-group col-md-3">
            <label>Producto: </label>
            <select class="custom-select" name="product" id="product" required>
              <option value="">--Select Producto--</option>
              <option value="Milk">Milk</option>
              <option value="Egg">Egg</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label>Ciudad (valor de otra tabla)</label>
            <?php
            $con = mysqli_connect("localhost", "root", "", "agencia_viajes");
            $city_name = '';
            $query = "SELECT city_name FROM city GROUP BY city_name ORDER BY city_name ASC";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) {
              $city_name .= '<option value="' . $row["city_name"] . '">' . $row["city_name"] . '</option>';
            }
            ?>
            <select name="city" id="city_name" class="custom-select" required>
              <option value="">--Select Ciudad--</option>
              <?php echo $city_name; ?>
            </select>
          </div>
        </div>
        <div class="form-row" align="left">
          <div class="form-group col-md-3 offset-md-6">
            <a href="index.php" class="btn btn-danger btn-block"><i class="fa fa-refresh"></i> Resetear</a></span>
          </div>
          <div class="form-group col-md-3">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i> Procesar</button>
          </div>
        </div>
      </form>
      <br>
      <style type="text/css">
        @media screen and (max-width: 767px) {
          .tg {
            width: auto !important;
          }

          .tg col {
            width: auto !important;
          }

          .tg-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin: auto 0px;
          }
        }
      </style>
      <div class="tg-wrap">
        <table id="table" class="display" cellspacing="0" style="width:100%">
          <thead style="font: bold; " active align="center">
            <tr>
              <td>Id</td>
              <td align=center>City Name</td>
              <td align=center>Farm Name</td>
              <td align=center>Product</td>
              <td align=center>Sales Date</td>
              <td align=center>Rate</td>
              <td align=center>Sales Qty/Ltr</td>
              <td align=center>Total (USD)</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $total = [
              'total' => 0,
              'amount' => 0,
              'totaltaka' => 0,
            ];
            foreach ($arr as $index => $unit) {
              $total = [
                'amount' => $total['amount'] + $unit['amount'],
                'totaltaka' => $total['totaltaka'] + $unit['totaltaka'],
              ];
              echo '<tr>';
              echo '<td align= center>' . ($index + 1) . '</td>';
              echo '<td align= center>' . $unit['city'] . '</td>';
              echo '<td align= center>' . $unit['farm_name'] . '</td>';
              echo '<td align= center>' . $unit['product'] . '</td>';
              echo '<td align= center>' . $unit['salesdate'] . '</td>';
              echo '<td align= center>' . $unit['rate'] . '</td>';
              echo '<td align= center>' . $unit['amount'] . '</td>';
              echo '<td align= center>' . $unit['totaltaka'] . '</td>';
              echo '</tr>';
            }
            echo '<tr align= center>';
            echo '<th colspan="6" style="text-align: right;">Total</th>';
            echo '<td ><b>' . $total['amount'] . '</b></td>';
            echo '<td ><b>' . $total['totaltaka'] . '</b></td>';
            echo '</tr>';
            ?>
          </tbody>
        </table>
      </div>



      <section class="container">

        <?php

        // Datos de conexión
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "agencia_viajes";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
          die("Error de conexión: " . $conn->connect_error);
        } else {
        }
        ?>

        <div class="mostrar-destinos container">
          <?php
          if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Obtener los valores del formulario
            $nombreHotel = $_GET["nombre_hotel"];
            $ciudad = $_GET["ciudad"];
            $pais = $_GET["pais"];
            $fecha = $_GET["fecha_viaje"];
            $duracion = $_GET["duracion_viaje"];

            // Realizar la búsqueda en la base de datos
            $consulta = "SELECT nombre_hotel, ciudad, pais, fecha_viaje, duracion_viaje
                 FROM destinos
                 WHERE nombre_hotel LIKE '%$nombreHotel%'
                 AND ciudad LIKE '%$ciudad%'
                 AND pais LIKE '%$pais%'
                 AND fecha_viaje = '$fecha'
                 AND duracion_viaje = $duracion";

            // Ejecutar la consulta y obtener los resultados
            $result = $conn->query($consulta);
          }



          if (isset($_GET['buscar'])) {

            $nombreHotel = $_GET['nombre_hotel'];
            $ciudad = $_GET['ciudad'];
            $fecha = $_GET['fecha_viaje'];
            $duracion = $_GET['duracion_viaje'];


            if (empty($_GET['nombre_hotel']) && empty($_GET['ciudad']) && empty($_GET['pais'])) {
              echo "ingrese su busqueda";
            } else {

              $sql = "select * from destinos";
              $result = mysqli_query($conn, $sql);

              while ($filas = mysqli_fetch_assoc($result)) {

                echo $filas['nombre_hotel'];
                echo $filas['ciudad'];
                echo $filas['pais'];
                echo $filas['fecha_viaje'];
                echo $filas['duracion_viaje'];
                echo "<a href='#" . $filas['id'] . "'></a>";
              }
            }
          }
          //cerrar conexión
          $conn->close();
          ?>

        </div>
      </section>

      <div>
        <div id="myModal" class="modal fade modal-dialog-centered hide show" tabindex="-1" style="padding-right: 19px; display: block;" aria-modal="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close " data-dismiss="modal" onclick="cerrarModal()">&times;</button>
              </div>
              <div class="modal-body">
                <a href="formulario2.php">
                  <img class="surveys-img" src="https://static.wixstatic.com/media/53103a_768da7c6e9dc45d09677a8fca3b90136~mv2.jpeg/v1/fill/w_500,h_500,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/53103a_768da7c6e9dc45d09677a8fca3b90136~mv2.jpeg" style="display: block; width:100%; height: auto;">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      function cerrarModal()
      {
        echo '<script>
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    </script>';
      }
      ?>

      <h5 class="text-uppercase text-center mb-4 font-weight-bold
text-warning">Ofertas Especiales</h5>
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner mb-4 container">
          <div class="carousel-item active card-fluid " data-bs-interval="4000">
            <div class="img-d ">
              <img src="https://content.r9cdn.net/rimg/dimg/2c/48/c98df9a4-hood-216543-16d3d901187.jpg?width=1366&height=768&xhint=2300&yhint=2416&crop=true" class="d-block w-100 " alt="...">
            </div>
            <span class="information"><span class="driver-text"><!----><!----> 10 DÍAS / 9 NOCHES </span>
              <div class="card-body">
                <h5 class="card-title">La Habana</h5>
                <p class="card-text">La Habana, capital de Cuba, es una ciudad histórica con arquitectura colonial, música vibrante y una autenticidad única. </p>
                <a href="#" class="btn btn-primary">Más Información</a>
              </div>
          </div>
          <div class="carousel-item card-fluid" data-bs-interval="4000">
            <div class="img-d ">
              <img src="https://content.r9cdn.net/rimg/dimg/c1/fc/3c27ba50-city-56855-556daf4d.jpg?width=1366&height=768&xhint=709&yhint=1279&crop=true" class="d-block w-100" alt="...">
            </div>
            <span class="information"><span class="driver-text"><!----><!----> 8 DÍAS / 7 NOCHES </span>

              <div class="card-body">
                <h5 class="card-title">Punta Cana</h5>
                <p class="card-text">Punta Cana es un popular destino turístico en la República Dominicana, conocido por sus playas de arena blanca, aguas cristalinas y resorts de lujo. </p>
                <a href="#" class="btn btn-primary">Más Información</a>
              </div>
          </div>
          <div class="carousel-item card-fluid">
            <div class="img-d ">
              <img src="https://res.cloudinary.com/hello-tickets/image/upload/c_limit,f_auto,q_auto,w_1300/v1669249654/hobocqv8h3aghnb5vvnt.jpg" class="d-block w-100" alt="...">
            </div>
            <span class="information"><span class="driver-text"><!----><!----> 9 DÍAS / 8 NOCHES </span>

              <div class="card-body">
                <h5 class="card-title">Cancún</h5>
                <p class="card-text">Cancún es un destino turístico en México, famoso por sus playas de arena blanca y aguas cristalinas.</p>
                <a href="#" class="btn btn-primary">Más Información</a>
              </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>



  </main>

  <footer class="  text-white pt-3 pb-4">
    <div class="container text-center text-md-start">
      <div class="row text-center text-md-start ">
        <!--sección nosotros-->
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase text-center mb-4 font-weight-bold
text-warning">Adventure World</h5>
          <hr class="mb-4 text-white">
          <p class="text-center text-danger"><i class="bi bi-airplane"></i></p>
        </div>
        <!--sección contacto-->
        <div class=" text-center col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase text-center font-weight-bold
text-warning">Contacto</h5>
          <hr class="mb-4 text-white">
          <p class="text-white">
            <i class="bi bi-house-door-fill text-danger"></i> Calle Diego de Rosales
            N°403, Santiago, Chile
          </p>
          <p class="text-white">
            <i class="bi bi-envelope-fill text-danger"></i> adventureworld@gmail.com
          </p>
          <p class="text-white">
            <i class="bi bi-telephone-fill text-danger"></i> +56 956295038
          </p>
        </div>
        <!--sección síguenos-->
        <div class="text-center col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase text-center mb-4 font-weight-bold
text-warning">Síguenos</h5>
          <hr class="mb-4 text-white">
          <a href="https://web.facebook.com/"><i class="bi bi-facebook
px-2 text-danger fs-2"></i></a>
          <a href="https://www.instagram.com/"><i class="bi bi-instagram
px-2 text-danger fs-2"></i></a>
          <a href="https://x.com/home?lang=es"><i class="bi bi-twitter
px-2 text-danger fs-2"></i></a>
        </div>
      </div>
    </div>
    <div class="text-center mb-2 pt-5 ">
      <p class="text-white">
        Copyright Todos los derechos reservados
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>

</html>