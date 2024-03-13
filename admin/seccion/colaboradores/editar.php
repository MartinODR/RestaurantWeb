<?php

include("../../bd.php");

if($_POST){   //esta istruccion es para recolectar los datos del formulario actual 

    //print_r($_POST); //comprobacion del envio de los datos POST

    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:""; //si envio, se le asigna valor, si no, vacio  
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $linkfacebook=(isset($_POST['linkfacebook']))?$_POST['linkfacebook']:""; 
    $linkinstagram=(isset($_POST['linkinstagram']))?$_POST['linkinstagram']:"";
    $linklinkedin=(isset($_POST['linklinkedin']))?$_POST['linklinkedin']:"";


    $sentencia=$conexion->prepare("UPDATE `tbl_colaboradores` 
    SET titulo=:titulo,
    descripcion=:descripcion,
    linkfacebook=:linkfacebook,
    linkinstagram=:linkinstagram,
    linklinkedin=:linklinkedin
    WHERE ID=:id");

    $sentencia->bindParam(":titulo",$titulo);  //introduccion de la variable inicializada en la sentencia SQL
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":linkfacebook",$linkfacebook);
    $sentencia->bindParam(":linkinstagram",$linkinstagram);
    $sentencia->bindParam(":linklinkedin",$linklinkedin);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();

    //Proceso de actualizacion de Foto
    $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";  //1)envio de foto
    $tmp_foto= $_FILES["foto"]["tmp_name"];


    if($foto!=""){
        
        $fecha_foto= new DateTime();//si no se renombra el archivo si se envia con el mismo nombre puede reescribir el archivo anterior 
        $nombre_foto=$fecha_foto->getTimestamp()."_".$foto; //recuperar los nombres

        move_uploaded_file($tmp_foto,"../../../images/colaboradores/".$nombre_foto); // moverla foto

        $sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE ID=:id"); //seleccionamos la foto antigua 
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY); //recuperacion del archivo de bd
        //print_r($registro_foto);//comprobar array entregado con nombre de la foto

        if(isset($registro_foto['foto'])){  //valida si existe el archivo
            if(file_exists("../../../images/colaboradores/".$registro_foto['foto'])){ //si existe el archivo
                unlink("../../../images/colaboradores/".$registro_foto['foto']); //borrarlo unlink de la foto antuigua 

            }
        }

        $sentencia=$conexion->prepare("UPDATE `tbl_colaboradores` 
        SET 
        foto=:foto
        WHERE ID=:id");
    
        $sentencia->bindParam(":foto",$nombre_foto);  //introduccion de la variable inicializada en la sentencia SQL
        $sentencia->bindParam(":id",$txtID);
    
        $sentencia->execute();

    }
}



if(isset($_GET['txtID'])){  //1)recive el GET evalua si hay un id

    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
   
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE ID=:id"); //2)si hay un id selecciono el registro perteneciente
    $sentencia->bindParam(":id", $txtID);                                            //a este id    
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);


    //Recuperacion de datos  (asignar al formulario) 3) y  recupero los datos y lo asigno al formulario
    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
    $foto=$registro["foto"];

    $linkfacebook=$registro["linkfacebook"];
    $linkinstagram=$registro["linkinstagram"];
    $linklinkedin=$registro["linklinkedin"];


    

   
}



include("../../templates/header.php");
?>

<br><br>
<div class="card">  <!--bs5-card-head-foot-->
    <div class="card-header">Colaboradores</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data"> <!--enctype para encriptar la foto si no se pone no se puede adjuntar la foto-->
            
            <div class="mb-3">
                <label for="titulo" class="form-label">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="Escriba el titulo del Banner"/>
            </div>
        
            <div class="mb-3"> <!--bs5-form-file-->
                <label for="foto" class="form-label">Foto:</label><br>
                <img width="100" src="../../../images/colaboradores/<?php echo $foto; ?>"/>
                <input type="file" class="form-control" name="foto" id="foto" placeholder="" aria-describedby="fileHelpId" />
            </div>

            <div class="mb-3"> <!--bs5-form-input-->
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" 
                value="<?php echo $titulo; ?>"
                class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <input type="text"
                value="<?php echo $descripcion; ?>" 
                class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder=""/>
            </div>
            
            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook:</label>
                <input type="text"
                value="<?php echo $linkfacebook; ?>"
                class="form-control" name="linkfacebook" id="linkfacebook" aria-describedby="helpId" placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram:</label>
                <input type="text" 
                value="<?php echo $linkinstagram; ?>"
                class="form-control" name="linkinstagram" id="linkinstagram" aria-describedby="helpId" placeholder=""/>
            </div>
            <div class="mb-3">
                <label for="linklinkedin" class="form-label">Linkedin:</label>
                <input type="text"
                value="<?php echo $linklinkedin; ?>"
                class="form-control" name="linklinkedin" id="linklinkedin" aria-describedby="helpId" placeholder=""/>
            </div>
             
            <button type="submit" class="btn btn-success">Modificar Colaborador</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>
    </div>  
    <div class="card-footer text-muted">


    </div>
</div>





<?php include("../../templates/footer.php"); ?>