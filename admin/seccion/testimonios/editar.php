<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
   
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_testimonios` WHERE ID=:id"); //https://www.php.net/manual/es/pdo.prepare.php
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    $opinion=$registro["opinion"];
    $nombre=$registro["nombre"];

}

if($_POST){

    $opinion=(isset($_POST["opinion"]))?$_POST["opinion"]:"";    //recepcion de post e iniciacion de variables 
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";

    $sentencia=$conexion->prepare("UPDATE tbl_testimonios SET
        opinion=:opinion,
        nombre=:nombre
        WHERE ID=:id");

    $sentencia->bindParam(":opinion", $opinion);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();


    header("Location:index.php");
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

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder=""/>
                
            </div>
            

            <div class="mb-3"> <!--bs5-form-input-->
                <label for="" class="form-label">Opinion</label>
                <input type="text" class="form-control" value="<?php echo $opinion; ?>" name="opinion" id="opinion" aria-describedby="helpId" placeholder="Opinion"/>
            </div>
        
            <div class="mb-3"> <!--bs5-form-intput-->
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" value="<?php echo $nombre ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre"/>
            </div>
          
            <button type="submit" class="btn btn-success">Modificar Testimonios</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>





<?php include("../../templates/footer.php"); ?>