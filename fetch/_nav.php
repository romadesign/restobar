<?php 
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}

$sql = "SELECT * FROM `sitedetail`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$systemName = $row['systemName'];
?>

<?php 
include('templates/header.php');
include 'fetch/_loginModal.php';
include 'fetch/_signupModal.php';
include 'fetch/_fetch_general.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="navbar-brand" href="index.php"><?php echo $systemName ?></a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php echo getCategorieNav() ?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="content_left">
        <?php
                $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
                $countresult = mysqli_query($conn, $countsql);
                $countrow = mysqli_fetch_assoc($countresult);      
                $count = $countrow['SUM(`itemQuantity`)'];
                if(!$count) {
                $count = 0; 
                } ?>
                <a href="viewCart.php">
                    <button type="button" class="btn btn-ligth mx-2" title="Mí pedido">
                        <i class="fas fa-shopping-cart"></i>
                        <i class="bi bi-cart"><?php echo $count  ?></i>
                    </button>
                </a>
                <?php 
                 
              if($loggedin){?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><?php echo $username ?></a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item ml-3" href="fetch/_logout.php"><i class="fas fa-power-off"></i>&nbsp; Salír</a>
                </ul>
            </div>
            <?php }else { ?>
            <button type="button" class="btn ml-3" data-bs-toggle="modal" data-bs-target="#loginModal"> Login</button>
            <div class="register">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#signupModal">Registrar</button>
            </div>
            <?php }
              ?>
        </div>
    </div>
</nav>

