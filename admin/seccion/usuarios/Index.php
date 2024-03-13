<?php include("../../bd.php");
//INSERT INTO `tbl_usuarios` (`ID`, `usuario`, `password`, `correo`) VALUES (NULL, 'Pololo', '123', 'pololo@hotmail.com');


if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();


    header("Location:index.php");
}



$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);  



include("../../templates/header.php");
?>
<br><br>
<div class="card"> <!--bs5-card-head-foot-->
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros </a>
    </div>
    <div class="card-body">
<div class="table-responsive-sm">  <!--bs5-table-default, table-responsive-sm-->
    <table
        class="table"
    >
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuario</th>
                <th scope="col">Password</th>
                <th scope="col">Correo</th>
                <th scope="col">Acciones: </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lista_usuarios as $registro){ ?>
                <tr class="">
                    <td><?php echo $registro["ID"]; ?></td>
                    <td><?php echo $registro["usuario"]; ?></td>
                    <td>*****</td>
                    <td><?php echo $registro["correo"]; ?></td>
                    <td>
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID']; ?>" role="button">Borrar</a>
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