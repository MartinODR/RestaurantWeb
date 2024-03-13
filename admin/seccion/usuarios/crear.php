<?php include("../../bd.php");

print_r($_POST);
echo "<br>";

if($_POST){

    $usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";
    
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $password=md5($password); //encriptacion de password averiguar seguridad

    //print_r($password); verificacion de encriptado

    $sentencia=$conexion->prepare("INSERT INTO                  
    `tbl_usuarios` (ID,usuario,password,correo) 
    VALUES (NULL,:usuario,:password,:correo);");
    $sentencia->bindParam(":usuario", $usuario);            //union de variables a instrucciones SQL
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->execute();                                 //llamado a la funcion(Objeto) de ejecutar instruccion 


  header("Location:index.php");                         //redireccionamiento
}








include("../../templates/header.php");
?>
<br><br>
<div class="card">  <!--bs5-card-hed-foot-->
    <div class="card-header">Agregar Registro</div>
    <div class="card-body">

        <form action="" method="post"> <!--form:post-->

        <div class="mb-3"> <!--bs5-form-input-->
            <label for="usuario" class="form-label">Nombre de Usuario</label>
            <input
                type="text"
                class="form-control"
                name="usuario"
                id="usuario"
                placeholder="introducir Usuario"
            />  <!-- aria-describedby="helpId"  esto estaba dentro de la etiqueta anterior input (averiguar efecto)-->
            <small id="helpId" class="form-text text-muted">Quiero dejar esto a modo de instrucciones</small>
        </div>
        
        <div class="mb-3"> <!--bs5-form-password-->
            <label for="" class="form-label">Password: </label>
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder="Introducir Password"
            />
            <small id="emailHelpId" class="form-text text-muted">agregar confirmacion de password</small>
        </div>
        <div class="mb-3"> <!--bs5-form-email-->
            <label for="" class="form-label">Correo:</label>
            <input
                type="email"
                class="form-control"
                name="correo"
                id="correo"
                aria-describedby="emailHelpId"
                placeholder="Introdicir Correo"
            />
            <small id="emailHelpId" class="form-text text-muted">texto de ayuda</small>
        </div>
               
            <button type="submit" class="btn btn-success">Agregar Usuario</button>
                <!--bs5-button-a-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>


        </form>
        
    </div>
    <div class="card-footer text-muted"></div>
</div>




<?php include("../../templates/footer.php"); ?>