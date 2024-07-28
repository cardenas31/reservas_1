<?php
session_start();
?>


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

        <nav class="navbar bg-dark-subtle fixed-top text-warning">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">AdventureWorld</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">AdventureWorld</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Destinos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#paquetes-turisticos">Paquetes Turísticos</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#ofertas-especiales">Ofertas Especiales</a>
                            </li>

                        </ul>

                        <div class="redes">
                            <a href="https://web.whatsapp.com/"><i class="bi bi-whatsapp text-warning"></i></a>
                            <a href="https://www.gmail.com/"><i class="bi bi-envelope text-warning"></i></a>

                        </div>

                        <div class="carrito-contenido">
                            <a href="carrito.php"><i class="bi bi-cart4"></i></a>

                        </div>

                    </div>

                </div>
            </div>
        </nav>


    </header>

    <main>

        <!--Modal inicio página-->
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


        <!--buscar vuelos-->
        <h1 class="container pt-5 mt-4">Busca tu Destino</h1>
        <div class="container formulario">

            <form class="container " action="" method="GET">
                <input type="text" name="vuelo" placeholder="Ingrese un vuelo">
                <input type="submit" value="Buscar">

            </form>

            <?php
            // Función para buscar vuelos
            if (isset($_GET["vuelo"]) && $_GET["vuelo"] != '') {
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "agencia";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                $vuelo = $_GET['vuelo'];

                $sql = "SELECT * FROM vuelo WHERE origen LIKE '%$vuelo%'";
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Desde</th><th>Destino</th><th>Fecha</th><th>Reservar</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["origen"] . "</td>";
                        echo "<td>" . $row["destino"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "<td>
                    <form action='index.php' method='post'>
                        <input type='hidden' name='id_vuelo' value='" . $row["id_vuelo"] . "'>
                        <button type='submit' name='reservar'>Reservar</button>
                    </form>
                  </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h4 style='color: white; font-weight: bold; text-align: center;'>Vuelo no Disponible</h4>";
                }

                $conn->close();
            }
            ?>


            <!--Buscar por hotel-->

            <form class="container pt-2" action="" method="GET">
                <input type="text" name="hotel" placeholder="Ingrese un hotel">
                <input type="submit" value="Buscar">

            </form>

            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "agencia";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            if (isset($_GET["hotel"]) && $_GET["hotel"] != '') {
                $hotel = $_GET["hotel"];

                $sql = "SELECT nombre, ubicacion, tarifa_noche FROM hotel WHERE nombre LIKE '%$hotel%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Nombre</th><th>Ubicación</th><th>Tarifa por Noche</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["ubicacion"] . "</td>";
                        echo "<td>$" . $row["tarifa_noche"] . "</td>";
                     
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h4 style='color: white; font-weight: bold; text-align: center;'>No se encontraron hoteles con ese nombre.</h4>";
                }
            }


            $conn->close();
            ?>

            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "agencia";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            //obtener el ID del vuelo seleccionado 
            if (isset($_POST["id_vuelo"])) {
                $id_vuelo = $_POST["id_vuelo"];


                // insertar la reserva en la tabla "reserva"
                $sql = "INSERT INTO reserva (id_cliente, fecha_reserva, id_vuelo, id_hotel) VALUES (?, NOW(), ?, ?)";
                $stmt = $conn->prepare($sql);
                $id_cliente = 1;
                $id_hotel = 1;

                $stmt->bind_param("iii", $id_cliente, $id_vuelo, $id_hotel);

                if ($stmt->execute()) {
                    echo "<p style='color: white; font-weight: bold; text-align: center;'>¡Reserva realizada con éxito!</p>";
                } else {
                    echo "<p style='color: red; font-weight: bold;'>Error al registrar la reserva: " . $stmt->error . "</p>";
                }

                $stmt->close();
            }

            $conn->close();
            ?>




        </div>

        <!--paquetes turísticos-->

        <section class="container pb-5" id="paquetes-turisticos">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2 class="mb-2 text-warning">Paquetes Turísticos</h2>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm col-md-6 col-lg ">

                        <div class="text p-3">
                            <div class="d-flex">
                                <div class="card">

                                    <img src="https://los40pa00.epimg.net/los40/imagenes/2017/11/22/formula40/1511370567_350883_1511371117_noticia_normal.jpg" class="card-img-top" alt="...">
                                    <h3><a href="#" name="nombre">San Blas, Panamá</a></h3>
                                    <p class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </p>

                                    <div class="">
                                        <span class="fw-bold" name="precio">$790.000</span>

                                    </div>

                                </div>

                            </div>
                            <p class="pt-3">
                                Viaja a San Blas, paquetes completos. Transporte, trip, comida, noche, tours.
                            </p>
                            <p class="days"><span>6 días / 5 noches</span></p>
                            <hr>
                            <p class="bottom-area d-block">

                                <a href="#" class="btn btn-primary">Descúbrelo</a>

                            <form action="agregar_al_carrito.php" method="post">
                                <input type="hidden" name="nombre" value="San Blas, Panamá">
                                <input type="hidden" name="precio" value="790000">
                                <button class="btn btn-primary" type="submit" name="agregar">Agregar al Carrito</button>
                            </form>
                            </p>

                        </div>

                    </div>


                    <div class="col-sm col-md-6 col-lg ">

                        <div class="text p-3">
                            <div class="d-flex">
                                <div class="card">
                                    <div class="img-cont">
                                        <img src="https://sa.visamiddleeast.com/dam/VCOM/regional/cemea/generic-cemea/travel-with-visa/destinations/paris/marquee-travel-paris-800x450.jpg" class="card-img-top " alt="...">
                                    </div>
                                    <h3><a href="#" name='nombre'>París, Francia</a></h3>
                                    <p class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </p>

                                    <div class="">
                                        <span class="fw-bold">$930.000</span>
                                    </div>
                                </div>

                            </div>
                            <p class="pt-3">
                                París no es solo la capital francesa, sino que también es la ciudad de la luz y del
                                amor.
                            </p>
                            <p class="days"><span>8 días / 7 noches</span></p>
                            <hr>
                            <p class="bottom-area d-block">

                                <a href="#" class="btn btn-primary">Descúbrelo</a>
                            <form action="agregar_al_carrito.php" method="post">
                                <input type="hidden" name="nombre" value="París, Francia">
                                <input type="hidden" name="precio" value="930000">
                                <button class="btn btn-primary" type="submit" name="agregar">Agregar al Carrito</button>
                            </form>
                            </p>


                        </div>


                    </div>

                    <div class="col-sm col-md-6 col-lg ">

                        <div class="text p-3">
                            <div class="d-flex">
                                <div class="card">
                                    <img src="https://c.files.bbci.co.uk/39E0/production/_104161841_singapore'ssparklingbusinessdistrictfoundingfatherleekuanyewkickedoffthekeepsingaporecleancampaignfiftyyearsagoinoctober2018-creditgettyimages.jpg" class="card-img-top" alt="...">
                                    <h3><a href="#">Singapur, Singapur</a></h3>
                                    <p class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </p>

                                    <div class="">
                                        <span class="fw-bold">$830.000</span>
                                    </div>
                                </div>

                            </div>
                            <p class="pt-3">
                                Viajes Baratos a Singapur. Reserva Ahora y Acumula Puntos. Ofertas
                                Limitadas.
                            </p>
                            <p class="days"><span>7 días / 6 noches</span></p>
                            <hr>
                            <p class="bottom-area d-block">

                                <a href="#" class="btn btn-primary">Descúbrelo</a>
                            <form action="agregar_al_carrito.php" method="post">
                                <input type="hidden" name="nombre" value="Singapur, Singapur">
                                <input type="hidden" name="precio" value="830000">
                                <button class="btn btn-primary" type="submit" name="agregar">Agregar al Carrito</button>
                            </form>
                            </p>
                        </div>

                    </div>

                    <div class="col-sm col-md-6 col-lg ">

                        <div class="text p-3">
                            <div class="d-flex">
                                <div class="card">
                                    <img src="https://tourismmedia.italia.it/is/image/mitur/1600X1000_storia_e_curiosita_su_roma_1-2?wid=800&hei=500&fit=constrain,1&fmt=webp" class="card-img-top" alt="...">
                                    <h3><a href="#" name='paquete'>Roma, Italia</a></h3>
                                    <p class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </p>

                                    <div class="">
                                        <span class="fw-bold" name='precio'>$750.000</span>
                                    </div>
                                </div>

                            </div>

                            <p class="pt-3">
                                ¿Quieres pasar unas Vacaciones en Roma al estilo Romano?, Ven a vivir la dolce vitta.

                            </p>

                            <p class="days"><span>5 días / 4 noches</span></p>
                            <hr>
                            <p class="bottom-area d-block ">

                                <a href="#" class="btn btn-primary">Descúbrelo</a>
                            <form action="agregar_al_carrito.php" method="post">
                                <input type="hidden" name="nombre" value="Roma, Italia">
                                <input type="hidden" name="precio" value="750000">
                                <button class="btn btn-primary" type="submit" name="agregar">Agregar al Carrito</button>
                            </form>
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </section>


        <section class="container" id="ofertas-especiales">
            <h2 class="mb-2 text-warning text-center pb-5">Ofertas Especiales</h2>
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner mb-4 container">
                    <div class="carousel-item active card-fluid " data-bs-interval="4000">
                        <div class="img-d ">
                            <img src="https://content.r9cdn.net/rimg/dimg/2c/48/c98df9a4-hood-216543-16d3d901187.jpg?width=1366&height=768&xhint=2300&yhint=2416&crop=true" class="d-block w-100 " alt="...">
                        </div>
                        <span class="information"><span class="driver-text"> 10 DÍAS / 9 NOCHES </span>
                            <div class="card-body">
                                <h5 class="card-title">La Habana</h5>
                                <p class="card-text">La Habana, capital de Cuba, es una ciudad histórica con arquitectura colonial, música vibrante y una autenticidad única. </p>
                                <a href="paquete_la_habana.php" class="btn btn-primary">Más Información</a>
                            </div>
                    </div>
                    <div class="carousel-item card-fluid" data-bs-interval="4000">
                        <div class="img-d ">
                            <img src="https://content.r9cdn.net/rimg/dimg/c1/fc/3c27ba50-city-56855-556daf4d.jpg?width=1366&height=768&xhint=709&yhint=1279&crop=true" class="d-block w-100" alt="...">
                        </div>
                        <span class="information"><span class="driver-text"> 8 DÍAS / 7 NOCHES </span>

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
                        <span class="information"><span class="driver-text"> 9 DÍAS / 8 NOCHES </span>

                            <div class="card-body">
                                <h5 class="card-title">Cancún</h5>
                                <p class="card-text">Cancún es un destino turístico en México, famoso por sus playas de arena blanca y aguas cristalinas.</p>
                                <a href="" class="btn btn-primary">Más Información</a>
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
        </section>

    </main>

    <footer class="  text-white pt-3 pb-4">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start ">
                <!--sección nosotros-->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">Adventure World</h5>
                    <hr class="mb-4 text-white">
                    <p class="text-center text-danger"><i class="bi bi-airplane"></i></p>
                </div>
                <!--sección contacto-->
                <div class=" text-center col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase text-center font-weight-bold text-warning">Contacto</h5>
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
                    <h5 class="text-uppercase text-center mb-4 font-weight-bold text-warning">Síguenos</h5>
                    <hr class="mb-4 text-white">
                    <a href="https://web.facebook.com/"><i class="bi bi-facebook px-2 text-danger fs-2"></i></a>
                    <a href="https://www.instagram.com/"><i class="bi bi-instagram px-2 text-danger fs-2"></i></a>
                    <a href="https://x.com/home?lang=es"><i class="bi bi-twitter px-2 text-danger fs-2"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mb-2 pt-5 ">
            <p class="text-white">
                Copyright Todos los derechos reservados
            </p>
        </div>
    </footer>

    <script src="https://assets.jumpseller.com/public/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js" integrity="sha256-9SEPo+fwJFpMUet/KACSwO+Z/dKMReF9q4zFhU/fT9M=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="app.js"></script>



</body>

</html>