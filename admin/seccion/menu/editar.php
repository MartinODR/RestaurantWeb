<?php
include("../../bd.php");

if($_POST){   //esta istruccion es para recolectar los datos del formulario actual 

    //print_r($_POST); //comprobacion del envio de los datos POST

    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $ingredientes=(isset($_POST["ingredientes"]))?$_POST["ingredientes"]:"";
    $precio=(isset($_POST["precio"]))?$_POST["precio"]:"";

    $sentencia=$conexion->prepare(" UPDATE tbl_menu SET 
    nombre=:nombre,
    ingredientes=:ingredientes,
    precio=:precio
    WHERE id = :id ");

    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":ingredientes",$ingredientes);
    $sentencia->bindParam(":precio",$precio);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

     //Proceso de actualizacion de Foto
     $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";  //1)envio de foto
     $tmp_foto= $_FILES["foto"]["tmp_name"];
 
 
     if($foto!=""){
         
         $fecha_foto= new DateTime();//si no se renombra el archivo si se envia con el mismo nombre puede reescribir el archivo anterior 
         $nombre_foto=$fecha_foto->getTimestamp()."_".$foto; //recuperar los nombres
 
         move_uploaded_file($tmp_foto,"../../../images/menu/".$nombre_foto); // moverla foto
 
         $sentencia=$conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID=:id"); //seleccionamos la foto antigua 
         $sentencia->bindParam(":id", $txtID);
         $sentencia->execute();
 
         $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY); //recuperacion del archivo de bd
         //print_r($registro_foto);//comprobar array entregado con nombre de la foto
 
         if(isset($registro_foto['foto'])){  //valida si existe el archivo
             if(file_exists("../../../images/menu/".$registro_foto['foto'])){ //si existe el archivo
                 unlink("../../../images/menu/".$registro_foto['foto']); //borrarlo unlink de la foto antuigua 
 
             }
         }
 
         $sentencia=$conexion->prepare("UPDATE `tbl_menu` 
         SET 
         foto=:foto
         WHERE ID=:id");
     
         $sentencia->bindParam(":foto",$nombre_foto);  //introduccion de la variable inicializada en la sentencia SQL
         $sentencia->bindParam(":id",$txtID);
     
         $sentencia->execute();
 
     }

     header("Location:index.php");

}


if(isset($_GET['txtID'])){  //1)recive el GET evalua si hay un id

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("SELECT * FROM `tbl_menu` WHERE ID=:id"); //2)si hay un id selecciono el registro perteneciente
    $sentencia->bindParam(":id", $txtID);                                            //a este id    
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    
    //Recuperacion de datos  (asignar al formulario) 3) y  recupero los datos y lo asigno al formulario
    $nombre=$registro["nombre"];
    $ingredientes=$registro["ingredientes"];
    $foto=$registro["foto"];
    $precio=$registro["precio"];

}

include("../../templates/header.php");
?>
<br><br>
    <div class="card"> <!--bs5-card-head-foot-->
        <div class="card-header">Menu de Comidas</div>
        <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"> <!--se debe agregar(enctype="multipart/form-data")a la etiqueta(foto)-->

        <div class="mb-3">  <!--bs5-form-input-->
            <label for="txtID" class="form-label">ID:</label>
            <input
                type="text"
                class="form-control"
                value="<?php echo $txtID; ?>"
                name="txtID"
                id="txtid"
                aria-describedby="helpId"
                placeholder=""
            />
           
        </div>
        

        <div class="mb-3"> <!--bs5-form-input, esto lo dejo tal cual lo envia Bootstrap-->
            <label for="nombre" class="form-label">Nombre:</label>
            <input
                type="text"
                class="form-control"
                value="<?php echo $nombre; ?>"
                name="nombre"
                id="nombre"
                aria-describedby="helpId"
                placeholder="Nombre"
            />
        </div>

        <div class="mb-3">  <!--bs5-form-input-->
            <label for="ingredientes" class="form-label">Ingredientes:</label>
            <input
                type="text"
                class="form-control"
                value="<?php echo $ingredientes; ?>"
                name="ingredientes"
                id="ingredientes"
                aria-describedby="helpId"
                placeholder="Ingredientes"
            />
        </div>
        <div class="mb-3"> <!--bs5-form-file, solo diferencia type="file"-->
            <label for="" class="form-label">Foto:</label>
            <br>
            <img width="100" src="../../../images/menu/<?php echo $foto; ?>"/>
            <input
                type="file"
                class="form-control"
                name="foto"
                id="foto"
                placeholder=""
                aria-describedby="fileHelpId"
            />
            <div id="fileHelpId" class="form-text">este div para ayuda ej tamanio foto</div>
        </div>
        
        <div class="mb-3">  <!--bs5-form-input-->
            <label for="precio" class="form-label">Precio:</label>
            <input
                type="text"
                class="form-control"
                value="<?php echo $precio; ?>"
                name="precio"
                id="precio"
                aria-describedby="helpId"
                placeholder="Precio"
            />
        </div>
        
        <button type="submit" class="btn btn-success">Modificar  Menu</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        


    </form>
        </div>
        <!--card footer-->
        </div>
    



<?php include("../../templates/footer.php"); ?>