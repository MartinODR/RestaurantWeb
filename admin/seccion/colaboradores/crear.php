<?php
include("../../templates/header.php");

include("../../bd.php");

if($_POST){   //asignacion de valores a las variables 

    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:""; //si envio, se le asigna valor, si no, vacio  
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $linkfacebook=(isset($_POST['linkfacebook']))?$_POST['linkfacebook']:""; 
    $linkinstagram=(isset($_POST['linkinstagram']))?$_POST['linkinstagram']:"";
    $linklinkedin=(isset($_POST['linklinkedin']))?$_POST['linklinkedin']:"";


//instruccion de inserccion en la bd
    $sentencia= $conexion->prepare("
    INSERT INTO `tbl_colaboradores` (`ID`, `titulo`, `descripcion`, `linkfacebook`, `linkinstagram`, `linklinkedin`, `foto`)
    VALUES (NULL, :titulo, :descripcion, :linkfacebook, :linkinstagram, :linklinkedin, :foto);");

    //asignacion de valor a la variable file foto, incluido el nombre y modificacion del nombre por fecha 
$foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:""; //name es el nombre del archivo
$fecha_foto= new DateTime();//si no se renombra el archivo si se envia con el mismo nombre puede reescribir el archivo anterior 
$nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
$tmp_foto=$_FILES["foto"]["tmp_name"]; //se recolecta el nombre temporal, dado en el arr de comprobacion abajo

if($tmp_foto!=""){
    move_uploaded_file($tmp_foto,"../../../images/colaboradores/".$nombre_foto); //mover el archivo a una carpeta, si no se assigna carpeta lo mueve a esta misma 
  }


//print_r($nombre_foto);//comprobacion del nuevo nombre de la foto asignado con la fecha timestamp
//print_r($_FILES);// Los archivos en php no pueden ser recolectados por el metodo post//comprobacion de array enviado 


    $sentencia->bindParam(":foto",$nombre_foto);
    $sentencia->bindParam(":titulo",$titulo);//instruccion para enviar los parametros 
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":linkfacebook",$linkfacebook);
    $sentencia->bindParam(":linkinstagram",$linkinstagram);
    $sentencia->bindParam(":linklinkedin",$linklinkedin);

    $sentencia->execute(); //ejecutar sentenci anterior para comprobacion de inserccion de datos en la bd

    header("Location:index.php"); //redirige al index de colaboradores
  // print_r($_POST); //comprobacion de envio
  // echo $linkfacebook; // confirmacion de valor de la variable 
}



?>
<br><br>
<div class="card">  <!--bs5-card-head-foot-->
    <div class="card-header">Colaboradores</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data"> <!--enctype para encriptar la foto si no se pone no se puede adjuntar la foto-->
            <div class="mb-3"> <!--bs5-form-file-->
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3"> <!--bs5-form-input-->
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder=""/>
            </div>
            
            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook:</label>
                <input type="text" class="form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram:</label>
                <input type="text" class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="linklinkedin" class="form-label">Linkedin:</label>
                <input type="text" class="form-control" name="linklinkedin" id="linklinkedin" aria-describedby="helpId" placeholder=""/>
            </div>
             
            <button type="submit" class="btn btn-success">Agregar Colaboradores</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>
    </div>  
    <div class="card-footer text-muted">


    </div>
</div>






<?php include("../../templates/footer.php"); ?>