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
        <a class="navbar-brand" href="index.php"><?php echo $systemName ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php echo getCategorieNav() ?>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <?php
                echo viewcart();

              if($loggedin){?>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><?php echo $username ?></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="fetch/_logout.php">Logout</a>
                    </ul>
                </div>
                <?php }else { ?>
                <button type="button" class="btn ml-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#signupModal">Registrar</button>
            <?php }
              ?>
        </div>
    </div>
</nav>