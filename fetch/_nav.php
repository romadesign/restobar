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
require ('db/dbconnect.php');

include 'components/_loginModal.php';
include 'components/_signupModal.php';
require('fetch/fetch.php'); 

$sql = "SELECT * FROM `sitedetail`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$systemName = $row['systemName'];

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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><?php categorieGet() ?></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contactanos</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a href="viewCart.php"><?php viewcart() ?></a>
            <?php 
           if($loggedin){?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Welcome '<?php echo $username ?>'
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li> <a class="dropdown-item" href="partials/_logout.php">Logout</a> </li>
                </ul>
            </div>
            <?php }else{ ?>
            <button type="button" class="btn btn-litgh" data-bs-toggle="modal" data-bs-target="#loginModal">
                Login
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">
                Registrar
            </button>
            <?php }?>
        </div>
    </div>
</nav>
<?php 



if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You can now login.
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
          </div>';
  }
  if(isset($_GET['error']) && $_GET['signupsuccess']=="false") {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> ' .$_GET['error']. '
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
          </div>';
  }
  if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are logged in
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
          </div>';
  }
  if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> Invalid Credentials
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
          </div>';
  }
?>