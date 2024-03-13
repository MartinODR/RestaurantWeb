 <!-- mostrar la lista de los registros que van a existir 
//en la base de datos ../ es para retroceder una carpeta-->
<?php //inclusion en la base de datos

include("../../bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_banners WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location:index.php"); //rediccionamiento al index

}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_banners`"); //https://www.php.net/manual/es/pdo.prepare.php
$sentencia->execute();
$lista_banners=$sentencia->fetchAll(PDO::FETCH_ASSOC);         //https://www.php.net/manual/es/pdostatement.fetchall.php

//print_r($lista_banners); //preba de que funciona la consulta SQL

include("../../templates/header.php");
?>

<!--bs5-card-head-foot-->
<br><br>
<div class="card">
    <div class="card-header">
             <!--bs5-button-a este boton es un enlace-->   
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros </a>
            

    </div>
    <div class="card-body">
        <!--bs5-table-default-->
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                        <?php foreach($lista_banners as $key => $value){ ?>
                            <tr class="">
                                <td scope="row"><?php echo $value['ID'] ?></td>
                                <td><?php echo $value['titulo'] ?></td>
                                <td><?php echo $value['descripcion'] ?></td>
                                <td><?php echo $value['link'] ?></td>
                                <td>
                                    <!--bs5-button-a ; caambiar de la class de primary a info cambia el color de boton-->
                                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['ID']; ?>" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['ID']; ?>" role="button">Borrar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php"); ?>


