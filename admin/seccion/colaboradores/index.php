<?php
include("../../bd.php");

if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    //Proceso de borrado que busque la imagen y la pueda borrar de la carpeta local.
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY); //recuperacion del archivo de bd
    //print_r($registro_foto);//comprobar array entregado con nombre de la foto

    if(isset($registro_foto['foto'])){  //valida si existe el archivo
        if(file_exists("../../../images/colaboradores/".$registro_foto['foto'])){ //si existe el archivo
            unlink("../../../images/colaboradores/".$registro_foto['foto']); //borrarlo unlink

        }
    }

    //aqui borra en la base de datos 
    $sentencia=$conexion->prepare("DELETE FROM tbl_colaboradores WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();


    header("Location:index.php");
}


$sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores`");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchAll(PDO::FETCH_ASSOC);  




include("../../templates/header.php");
?>
<br>
<br>
<div class="card">          <!--bs5-card-head-foot-->
    <div class="card-header">Colaboradores
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros </a>
    </div>
    <!--bs5-table-default  table-responsive-sm  table-light(quitado queda blanco el fondo)-->
    <div class="card-body">
       <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>

                    <th scope="col">Info</th>
                    <th scope="col">Redes Sociales</th>
                    <th scope="col">Acciones</th>

                    <!--ID	titulo	descripcion	linkfacebook	linkinstagram	linklinkedin	foto(referencia de la tabla)-->	



                </tr>
            </thead>
            <tbody>

                <?php foreach($lista_colaboradores as $key => $value) { ?>
                <tr class="">
                    <td scope="row"><?php echo $value['ID']; ?></td>
                    <td><?php echo $value['titulo']; ?></td>
                    <td>
                        <img src="../../../images/colaboradores/<?php echo $value['foto']; ?>" width="50" alt=""> <!--mostrar miniatura-->
                    </td>

                    <td><?php echo $value['descripcion']; ?></td>
                    <td>
                        <?php echo $value['linkfacebook']; ?><br>
                        <?php echo $value['linkinstagram']; ?><br>
                        <?php echo $value['linklinkedin']; ?>
                    </td>

                    <td>
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



<!--INSERT INTO `tbl_colaboradores` (`ID`, `titulo`, `descripcion`, `linkfacebook`, `linkinstagram`, `linklinkedin`, `foto`)
 VALUES (NULL, 'Ricardo el Cheff', 'El cheff de comida picante', 'http://facebook.com/Ricardo', 'http://instagram.com/Ricardo', 'http://linkedin.com/Ricardo', 'foto.jpg');-->
<?php include("../../templates/footer.php"); ?>