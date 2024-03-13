<?php
include("../../bd.php");

if($_POST){

   // print_r($_POST); //comprobacion de recepcion de datos post

    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $ingredientes=(isset($_POST["ingredientes"]))?$_POST["ingredientes"]:"";
    $precio=(isset($_POST["precio"]))?$_POST["precio"]:"";


    $sentencia=$conexion->prepare("INSERT INTO                  
    `tbl_menu` (`ID`, `nombre`, `ingredientes`, `foto`, `precio`) 
    VALUES (NULL,:nombre,:ingredientes,:foto,:precio);");

        //1)a parte lo de la foto 
    //asignacion de valor a la variable file foto, incluido el nombre y modificacion del nombre por fecha 
    $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:""; //name es el nombre del archivo
    $fecha_foto= new DateTime();//si no se renombra el archivo si se envia con el mismo nombre puede reescribir el archivo anterior 
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmp_foto=$_FILES["foto"]["tmp_name"]; //se recolecta el nombre temporal, dado en el arr de comprobacion abajo

    if($tmp_foto!=""){
        move_uploaded_file($tmp_foto,"../../../images/menu/".$nombre_foto); //mover el archivo a una carpeta, si no se assigna carpeta lo mueve a esta misma 
    }   
    // print_r($foto); //comprobacion de recepcion de foto, entrega array de los datos de foto que tiene el ["name"]


    $sentencia->bindParam(":nombre", $nombre);      
    $sentencia->bindParam(":ingredientes", $ingredientes);      
    $sentencia->bindParam(":foto", $nombre_foto);      
    $sentencia->bindParam(":precio", $precio);      
    $sentencia->execute();                                 //llamado a la funcion(Objeto) de ejecutar instruccion 

    header("Location:index.php");
}




include("../../templates/header.php");
?>
<br><br>
    <div class="card"> <!--bs5-card-head-foot-->
        <div class="card-header">Menu de Comidas</div>
        <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data"> <!--se debe agregar(enctype="multipart/form-data")a la etiqueta(foto)-->

        <div class="mb-3"> <!--bs5-form-input, esto lo dejo tal cual lo envia Bootstrap-->
            <label for="nombre" class="form-label">Nombre:</label>
            <input
                type="text"
                class="form-control"
                name="nombre"
                id="nombre"
                aria-describedby="helpId"
                placeholder="Nombre"
            />
        </div>

        <div class="mb-3">  <!--bs5-form-input-->
            <label for="ingredientes" class="form-label">Ingredientes</label>
            <input
                type="text"
                class="form-control"
                name="ingredientes"
                id="ingredientes"
                aria-describedby="helpId"
                placeholder="Ingredientes"
            />
        </div>
        <div class="mb-3"> <!--bs5-form-file, solo diferencia type="file"-->
            <label for="" class="form-label">Foto</label>
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
            <label for="precio" class="form-label">Precio</label>
            <input
                type="text"
                class="form-control"
                name="precio"
                id="precio"
                aria-describedby="helpId"
                placeholder="Precio"
            />
        </div>
        
        <button type="submit" class="btn btn-success">Agregar al Menu</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        


    </form>
        </div>
        <!--card footer-->
        </div>
    




<?php include("../../templates/footer.php"); ?>