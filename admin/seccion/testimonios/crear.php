<?php 
include("../../bd.php");

if($_POST){

//print_r($_POST); //comprobacion de envio POST
//instruccion de la base de datos al insertar los valores manualmente
//INSERT INTO `tbl_testimonios` (`ID`, `opinion`, `nombre`) VALUES (NULL, 'Muy buena y recomendada Comida', 'Carla');

    $opinion=(isset($_POST["opinion"]))?$_POST["opinion"]:"";    //recepcion de post e iniciacion de variables 
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";


    $sentencia=$conexion->prepare("INSERT INTO                  
    `tbl_testimonios` (`ID`, `opinion`, `nombre`) 
    VALUES (NULL,:opinion,:nombre);");
    $sentencia->bindParam(":opinion", $opinion);            //union de variables a instrucciones SQL
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->execute();                                 //llamado a la funcion(Objeto) de ejecutar instruccion 


    header("Location:index.php");                         //redireccionamiento
}



include("../../templates/header.php");
?>
<br><br>
<div class="card">  <!--bs5-card-head-foot-->
    <div class="card-header">
        Testimonios
    </div>
    <div class="card-body">

       <form action="" method="post">  <!--form:POST-->

            <div class="mb-3"> <!--bs5-form-input-->
                <label for="" class="form-label">Opinion</label>
                <input type="text" class="form-control" name="opinion" id="opinion" aria-describedby="helpId" placeholder="Opinion"/>
            </div>
        
            <div class="mb-3"> <!--bs5-form-intput-->
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre"/>
            </div>
          
            <button type="submit" class="btn btn-success">Agregar Testimonios</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>





<?php include("../../templates/footer.php"); ?>