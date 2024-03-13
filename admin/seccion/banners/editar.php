<!--// nos permite mostrar una interface que conecte 
//directamente con la base de datos//Formulario de Editar Registros-->

<?php 
include("../../bd.php");
if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
   
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_banners` WHERE ID=:id"); //https://www.php.net/manual/es/pdo.prepare.php
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
    $link=$registro["link"];

}
if($_POST){

    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";  //recepcion de los valores e inicializacion de la variable 
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
    $link=(isset($_POST["link"]))?$_POST["link"]:"";
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";

    $sentencia=$conexion->prepare("UPDATE `tbl_banners` 
                SET titulo=:titulo, descripcion=:descripcion, link=:link
                WHERE ID=:id");

$sentencia->bindParam(":titulo",$titulo);  //introduccion de la variable inicializada en la sentencia SQL
$sentencia->bindParam(":descripcion",$descripcion);
$sentencia->bindParam(":link",$link);
$sentencia->bindParam(":id",$txtID);

$sentencia->execute();
    
header("Location:index.php");
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
                <label for="titulo" class="form-label">ID</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="Escriba el titulo del Banner"/>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el titulo del Banner"/>
            </div>
             <!--bs5-form-input-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escriba la descripcion del Banner" />
            </div>
            <!--bs5-form-input-->
            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" value="<?php echo $link; ?>" name="link" id="link" aria-describedby="helpId" placeholder="Escriba el enlace"/>
            </div>

                <button type="submit" class="btn btn-success">Modificar Banner</button>
                <!--bs5-button-a-->
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>    



    </div>
    <div class="card-footer text-muted">
    
    </div>
</div>
<?php include("../../templates/footer.php"); ?>


