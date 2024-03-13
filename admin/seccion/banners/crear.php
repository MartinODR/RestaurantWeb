<!-- muestra toda la parte de creacion de los registros 
de la base de datos Formulario de Crear Registros--> 

<?php 
include("../../bd.php");
//print_r($_POST);  //verificacion de los datos enviados en Post en un array
if($_POST){

    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";  //recepcion de los valores e inicializacion de la variable  
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
    $link=(isset($_POST["link"]))?$_POST["link"]:"";

    //print_r($titulo.$descripcion.$link); //prueba de que las variables reciven valor

    $sentencia=$conexion->prepare("INSERT INTO `tbl_banners` 
                                (`ID`, `titulo`, `descripcion`, `link`)
                                VALUES (NULL, :titulo, :descripcion, :link);");

    $sentencia->bindParam(":titulo",$titulo);  //introduccion de la variable inicializada en la sentencia SQL
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":link",$link);

    $sentencia->execute();  
    header("Location:index.php"); //redireccion y envio hacia la pagina de la lista cuando los valores se hayan introducido 

}
include("../../templates/header.php"); 
?>
<!--bs5-card-head-foot-->
<br><br>
<div class="card">
    <div class="card-header">
        Banners
    </div>
    <div class="card-body">

        <form action="" method="post">

        
            <!--bs5-form-input-->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el titulo del Banner"/>
            </div>
             <!--bs5-form-input-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba la descripcion del Banner" />
            </div>
            <!--bs5-form-input-->
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Escriba el enlace"/>
            </div>

                <button type="submit" class="btn btn-success">Crear banner</button>
                <!--bs5-button-a-->
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>    
 


    </div>
    <div class="card-footer text-muted">
    
    </div>
</div>



<?php include("../../templates/footer.php"); ?>
