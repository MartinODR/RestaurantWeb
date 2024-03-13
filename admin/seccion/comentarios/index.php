<?php
include("../../bd.php");

//INSERT INTO `tbl_comentarios` (`ID`, `nombre`, `correo`, `mensaje`)
// VALUES (NULL, 'Loquita', 'loquitatuya@gmail.com', 'Mejor que la tuya no hay');

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_comentarios WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location:index.php"); //rediccionamiento al index

}



$sentencia=$conexion->prepare("SELECT * FROM `tbl_comentarios`");
$sentencia->execute();
$lista_comentarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);  


include("../../templates/header.php");
?>
<br><br>

<div class="card"> <!--bs5-card-head-foot-->
    <div class="card-header">
        Bandeja de Comentarios 
    </div>
    <div class="card-body">
        <div class="table-responsive-sm"> <!--bs5-table-default, table-responsive-sm-->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID:</th>
                        <th scope="col">Nombre:</th>
                        <th scope="col">Correo:</th>
                        <th scope="col">Mensaje:</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($lista_comentarios as $registro){ ?>
                        <tr class="">
                            <td><?php echo $registro["ID"]; ?></td>
                            <td><?php echo $registro["nombre"]; ?></td>
                            <td><?php echo $registro["correo"]; ?></td>
                            <td><?php echo $registro["mensaje"]; ?></td>
                            <td> 
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID']; ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID']; ?>" role="button">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">

    </div>
</div>






<?php include("../../templates/footer.php"); ?>