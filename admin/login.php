<?php
//Para crear sesions diferenciadas en privilegios se puede crear un tipo de dato de diferente privilegio y diferenciar 
//el acceo mediante condicionales en el header de administracion para un tipo diferente de inicio de sesion 
//se puede crear un condicional cuando se accede al inicio de sesion con los datos de base de datos diferenciados y asi 
//crear un otro inicio de sesion con diferentes privilegios // se agregaria un campo en la bd que seria el tipo de permiso 
//al que se accede en el inicio de sesion 
//se puede validar a nivel de menu o crear un menu diferente ,  diferentes administradores o mero usuario 

//Si se utiliza encriptacion se debe validar el dato// en la BD se almacena el dato encriptado que no coincide con la contrsenia escrita
//Para eso se debe encriptar el dato en el momento de ingresar el dato en el formulario de login con el mismo algoritmo de encriptacion 
//que se uso al crear el usuario asi coincidiran los datos encriptados y no el password original 
//Martin147852369
    session_start(); //1)variable de sesion para restringir acceso al admin

    if($_POST){

        include("bd.php"); //base de datos en mismo directorio 

       // print_r($_POST); //Array ( [usuario] => Pololo [password] => 123 ) // verificacion de $_POST

        $usuario=(isset($_POST["usuario"]))?$_POST["usuario"]:"";               //recepcion de los campos 
        $password=(isset($_POST["password"]))?$_POST["password"]:"";
        
        $password=md5($password);    //aqui se le aplica el algoritmo de encriptacion para ya validarlo directemente en la busqueda de la bd
        //print_r(md5($password)); // ver la encriptacion para trabajar 

        //busqueda en la base de datos, se asigna un conteo a una variable, para que se haga la busqueda a travez de un usuario y contrasenia 
        $sentencia=$conexion->prepare("SELECT *, count(*) as n_usuario          
                                    FROM tbl_usuarios 
                                    WHERE usuario=:usuario
                                    AND password=:password
                                    ");
                $sentencia->bindParam(":usuario",$usuario);
                $sentencia->bindParam(":password",$password);
                $sentencia->execute();                                      //se ejecuta la sentencia 
                $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);       //se obriene la lista(el usuario) que se encontro  
                $n_usuario=$lista_usuarios["n_usuario"];                //el n_usuario encontrado, se recolecta y se envia a la variable 

                $_SESSION["usuario"]=$lista_usuarios["usuario"]; //2)vincula la variable de inicio de ssion con la variable $_SESSION global 
                $_SESSION["logueado"]=true;                                                        
               // print_r($n_usuario);     //impresion del usuario encontrado (prueba), si lo encuantra entrega (1) si no (0)  
                if($n_usuario==1){                   //validacion 
                    
                 header("Location:index.php");
                }else{
                    $mensaje="usuario o contrasenia incorrectos...";
                }
        }   

?>
<!--bs5-$-->
<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>

        <main>

        <!--bs5-grid-container-->
       <div class="container">
        <div class="row">
            <div class="col"></div>

            <div class="col">
            <br><br>
            <!--bs5-alert-default, alert-danger-->
            <?php if(isset($mensaje)){?>

            <div
                class="alert alert-danger"
                role="alert"
            >
                <strong>Error: </strong><?php echo $mensaje ?>
            </div>
            
            <?php } ?>

            <!--bs5-card-align-->
            <div class="card text-center">
                <div class="card-header">Login</div>
                <div class="card-body">

                <form action="login.php" method="post">

                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder=""/>
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                 
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder=""/>
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <!--bs5-button-default-->
                <button type="submit" class="btn btn-primary">Login</button>
                

                </form>

                </div>
            </div>
            

            </div>

            <div class="col"></div>
        </div>
        
       </div>
       

        </main>
       
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
