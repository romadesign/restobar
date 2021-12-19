<?php include_once('fetch/_login.php') ?>
<?php include_once('templates/header.php') ?>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center vh-100">
        <div class="card col-md-8">
            <div class="card-body">
            <?php
                if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Atención!</strong> Este usuario no tiene las credenciales para ingresar
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                if(isset($_GET['loginwarning']) && $_GET['loginwarning']=="false"){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Atención!</strong> Este usuario no existe
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                if(isset($_GET['loginincorrectsuccess']) && $_GET['loginincorrectsuccess']=="false"){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Atención!</strong>Contraseña incorrecta
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                
            ?>
                <form action="<?php login() ?>" method="post">
                    <div class="form-group">
                        <label for="username" class="control-label"><b>Username</b></label>
                        <input type="text" id="username" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label"><b>Password</b></label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                        <button type="submit" class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button>
                    <div id="login-right">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php include_once('templates/footer.php') ?>


        