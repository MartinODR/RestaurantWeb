<?php
include("../../bd.php");
/* INSERT INTO
 `tbl_menu` (`ID`, `nombre`, `ingredientes`, `foto`, `precio`) VALUES 
 (NULL, 'Conchita Mulli', 'Carne de Puerca, Crema y Lenguado en la raja', 'Fotos.jpg', '100 pistolasos ');*/

 if(isset($_GET['txtID'])){

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    //Proceso de borrado que busque la imagen y la pueda borrar de la carpeta local.
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY); //recuperacion del archivo de bd
    //print_r($registro_foto);//comprobar array entregado con nombre de la foto

    if(isset($registro_foto['foto'])){  //valida si existe el archivo
        if(file_exists("../../../images/menu/".$registro_foto['foto'])){ //si existe el archivo
            unlink("../../../images/menu/".$registro_foto['foto']); //borrarlo unlink

        }
    }

    //aqui borra en la base de datos 
    $sentencia=$conexion->prepare("DELETE FROM tbl_menu WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();


    header("Location:index.php");
 }


 $sentencia=$conexion->prepare("SELECT * FROM `tbl_menu`");
 $sentencia->execute();
 $lista_menu=$sentencia->fetchAll(PDO::FETCH_ASSOC);  

 //print_r($lista_menu); //comprobacion de recepcion de array



include("../../templates/header.php");
?>
<br><br>

    <div class="card">      <!--bs5-card-head-foot-->
        <div class="card-header">Menu de Comidas
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros </a>
        </div>
        <div class="card-body">
     
        <div class="table-responsive-sm">  <!--bs5-table-default, table-responsive-sm, le borra el table primary-->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ingredientes</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($lista_menu as $registro){ ?>
                        <tr class="">
                            <td><?php echo $registro['ID'];?></td>
                            <td><?php echo $registro['nombre'];?></td>
                            <td><?php echo $registro['ingredientes'];?></td>
                            <td><img src="../../../images/menu/<?php echo $registro['foto']; ?>" width="50" alt=""></td> <!--mostrar miniatura-->
                            <td><?php echo $registro['precio'];?></td>
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
        <div class="card-footer text-muted"></div>
    </div>






<?php include("../../templates/footer.php"); ?>