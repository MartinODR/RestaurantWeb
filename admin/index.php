<?php include("templates/header.php"); ?>

<!--bs5-jumbotron-default-->
<br><br>
<div class="row align-items-md-stretch">
    <div class="col-md-12">
        <div class="h-100 p-5 border rounded-3">
            <h2>Welcome to the Administrator <?php echo $_SESSION["usuario"]; ?> </h2> 
            <p>
            This is the administration space, be careful :) 
            </p>
            <button class="btn btn-outline-primary" type="button">Start</button> 
        </div>
    </div>
    
</div>

<?php include("templates/footer.php"); ?>