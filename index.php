<?php
include("admin/bd.php");

//Banners
$sentencia=$conexion->prepare("SELECT * FROM tbl_banners ORDER BY id ASC limit 1"); //me gustaria cambiarlo al seleccionado, limit 1 reg 
$sentencia->execute();
$lista_banners= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Colaboradores
$sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores ORDER BY id");  //lectura de tabla colaboradores, sin limit
$sentencia->execute();
$lista_colaboradores= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Testimonios
$sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios ORDER BY id limit 2"); //lectura de tabla testimonios, limite de 2 registros
$sentencia->execute();
$lista_testimonios= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//Menu
$sentencia=$conexion->prepare("SELECT * FROM tbl_menu ORDER BY id limit 4"); //lectura de tabla testimonios, limite de 2 registros
$sentencia->execute();
$lista_menus= $sentencia->fetchAll(PDO::FETCH_ASSOC);

//print_r($lista_testimonios); //verificacion de entrega de array

if($_POST){

    //print_r($_POST); //verificacion de envio de datos 
    //Array ( [nombre] => Martono [correo] => tuculoenbicicleta@gmail.com [mensaje] => Guenazo todo ) array entregado
    //se deb e aplicar seguridad, (Sanitizar Datos) //esto inserta datos en la tabla comentarios 

    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $correo=filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL);
    $mensaje=filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);

    if($nombre && $correo && $mensaje){
       //echo "todo bien";
       $sql="INSERT INTO 
       tbl_comentarios (nombre, correo, mensaje)
        VALUES (:nombre, :correo, :mensaje)";

       $resultado = $conexion->prepare($sql);
       $resultado ->bindParam(':nombre', $nombre, PDO::PARAM_STR);     
       $resultado ->bindParam(':correo', $correo, PDO::PARAM_STR);
       $resultado ->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
       $resultado ->execute(); 

    }
    header("Location:index.php");
}




?>

<!doctype html>    <!--bs5-$-->
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body>
    <!--bs5-navbar-minimal-ul-->
    <!--Seccion de Menu de navegacion-->
    <nav id="inicio" class="navbar navbar-expand-lg navbar-dark bg-dark">  
    <div class="container">   

    <a class="navbar-brand" href="#"><i class="fas fa-utensils"></i>MATILDA'S Restaurant</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-control="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav navbar-nav ml-auto">
                
                <li class="nav-item">
                    <a class="nav-link" href="#inicio">Start</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#menu">Today's menu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#chefs">Our Team</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#testimonios">Testimonials</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contacto">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#horario">Schedules</a>
                </li>

            </ul>
        </div>

    </div>
    </nav>
    
    <!--Seccion del Banner-->
    <section class="container-fluid p-0">
    <div class="banner-img" style="position:relative; background:url('images/slider-image3.jpg') center/cover no-repeat; height:400px">


        <div class="banner-text" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); text-align:center; color:#fff ">
          
            <?php foreach($lista_banners as $banner){ ?>

            <h1><?php echo $banner['titulo']; ?></h1> 
            <p><?php echo $banner['descripcion']; ?></p>
            <a href="<?php echo $banner['link']; ?>" class="btn btn-primary">Menu of the week</a>
            <?php } ?>
        </div>

    </div>
    </section>

    <section id="id" class="container mt-4 text-center"> <!--bs5-jumbotron-default-->
        <div class="jumbotron bg-dark text-white">
            <br/>
                <h2>Welcome to Restaurant MATILDA!</h2>
                <p>Discover a unique culinary experience</p>
            <br/>    
        </div>
    </section>
    
    <!--Seccion de Chefs-->
    <section id="chefs" class="container mt-4 text-center">
    <h2>Our Chefs</h2>

    <div class="row">
        <?php foreach($lista_colaboradores as $colaborador){ ?>
        <div class="col-md-4">
            <div class="card">
                <img src="images/colaboradores/<?php echo $colaborador["foto"];?>" 
                class="card-img-top" 
                alt="Chef 1"
                />
                <div class="card-body">
                    <h5 class="card-title"><?php echo $colaborador["titulo"];?></h5>
                    <p class="card-text"><?php echo $colaborador["descripcion"];?></p>
                    <div class="social-icons mt-3">
                        <a href="<?php echo $colaborador["linkfacebook"]?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo $colaborador["linkinstagram"]?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo $colaborador["linklinkedin"]?>" class="text-dark me-2"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
       <?php } ?>
    </div>

    </section>
 
    <!--Seccion Testimonios-->
    <section id="testimonios" class="bg-light py-5">
        <div class="container">

            <h2 class="text-center mb-4">Testimonials</h2>
    
            <div class="row">
                
               <?php foreach($lista_testimonios as $testimonio){ ?>

                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text"><?php echo $testimonio["opinion"]; ?> </p>
                        </div>
                        <div class="card-footer text-muted">
                            <?php echo $testimonio["nombre"]; ?>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>

        </div>
    </section>   

    <!--Seccion del Menu de Comida-->
    <section id="menu" class="container mt-4">
        
        <h2 class="text-center">Menu (our recommendations) </h2>
        <br/>
        <div class="row row-cols-1 row-cols-md-4 g-4">

                <?php foreach($lista_menus as $registro){ ?>

            <div class="col d-flex">
                <div class="card">
                    <img src="images/menu/<?php echo $registro['foto']; ?>" alt="Falta Imagen"  class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title" ><?php echo $registro["nombre"] ?></h5>
                        <p class="card-text small"> <strong>Ingredients: </strong><?php echo $registro['ingredientes'];?></p>
                        <p class="card-text"><strong>Price:</strong><?php echo $registro['precio'];?></p>
                    </div>
                </div>    
            </div>

            <?php } ?>

        </div>

    </section>
        <br/>
        <br/>

        <!--Seccion de Contacto-->
       <section id="contacto" class="container mt-4">

        <h2>Contact Us</h2>  
        <p>We are here to serve you</p>
        
        <form action="?" method="post">

            <div class="mb-3">
                <label for="name">Name:</label><br/>
                <input type="text" class="form-control" id="name" name="nombre" placeholder="Enter your name..." required><br/>
            </div>

            <div class="mb-3">
                <label for="email">E-MAIL</label><br/>
                <input type="email" class="form-control" id="email" name="correo" placeholder="Enter your email address..." required><br/>
            </div>
            
            <div class="mb-3">
                <label for="message">Message</label></br>
                <textarea id="message" class="form-control" name="mensaje"  cols="50" rows="6"></textarea></br>
            </div>

            <input type="submit" class="btn btn-primary" value="Enviar mensaje">
            
        </form>

       </section>
        <br/><br/>
             <!--Seccion de Horarios-->
        <div id="horario" class="text-center bg-light p-4">
            <h3 class="mb-4">Customer service schedule</h3>


           
            <div>
                <p class=""> <strong>Monday to Friday</strong></p>
                <p class=""> <strong>11:00 a.m - 10:00 p.m</strong></p>
            </div>
            <div>
                <p class=""> <strong>Saturday</strong></p>
                <p class=""> <strong>11:00 a.m - 10:00 p.m</strong></p>
            </div>
            <div>
                <p class=""> <strong>Sunday</strong></p>
                <p class=""> <strong>07:00 a.m - 4:00 p.m</strong></p>
            </div>


        </div>

       
        <footer class="bg-dark text-light text-center py-3">
            <!-- place footer here -->
            <p> &copy; 2024 Restaurant Matilda's, All rights reserved. Website built for learning purposes only</p>
        </footer>
       
       
       
       
       
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    
    
    
    </body>
</html>
