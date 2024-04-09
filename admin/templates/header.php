
<?php
 session_start();
 print_r($_SESSION);
 $url_base="http://localhost/proyectosGitHub/RestaurantWeb/admin/";
             
    if(!isset($_SESSION["usuario"])){       //seguridad para no mostrar las paginas a menos que haya iniciada una sesion 
                                            
        header("Location:".$url_base."login.php"); //si la sesion no esta iniciada se redirecciona al login 



    }

 ?>



<!doctype html>
<html lang="en">
    <head>
        <title>Website Administrator</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 --><!--integracion de jqueri a partir de la etiqueta <script>--> 
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />

        <!--integracion de jqueri a partir de la etiqueta <script>, nos permite utilizar (filtros de busqueda) el script va en el footer tambien  --> 
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>


        
    </head>

    <body>
        <header>
            <!-- place navbar here (bs5-navbar-minimal-a-->
            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="<?php echo $url_base;?>index.php" aria-current="page">Administrador<span class="visually-hidden">(current)</span></a>
                    
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/banners/">Banners</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/colaboradores/">Collaborators</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/testimonios/">Testimonials</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/menu/">Menu</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/comentarios/">Comments</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>seccion/usuarios/">Users</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>cerrar.php">Sign off</a>
                </div>
            </nav>
            
        </header>
        <main>
<section class="container">