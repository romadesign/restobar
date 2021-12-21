<?php 
function getCategorieNav(){
  include('db/dbconnect.php');
  $sql = "SELECT categorieName, categorieId FROM categories"; 
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){?>
<a class="dropdown-item"
    href="viewMenuList.php?catid=<?php echo $row['categorieId'] ?>"><?php echo $row['categorieName'] ?> </a>
<?php }
}

?>

<?php 
function viewcart(){
  include('db/dbconnect.php');
  if(isset($_SESSION['userId'])){
  $userId = $_SESSION['userId'];

  $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
  $countresult = mysqli_query($conn, $countsql);
  $countrow = mysqli_fetch_assoc($countresult);      
  $count = $countrow['SUM(`itemQuantity`)'];
  if(!$count) {
  $count = 0; 
  } ?>
    <a href="viewCart.php">
    <button type="button" class="btn btn-warning mx-2" title="Mí pedido">
      <svg xmlns="img/cart.svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
          <path
              d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
      </svg>
      <i class="bi bi-cart"><?php echo $count  ?></i>
    </button>
  </a>
<?php }
} ?>

<?php 
function getCategorie(){
  include('db/dbconnect.php');
  $sql = "SELECT * FROM `categories`"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $id = $row['categorieId'];
      $cat = $row['categorieName'];
      $desc = $row['categorieDesc']; ?>
      <div class="col-sm-4 col-md-3 mb-3">
          <div class="card menu_content" style="width:100%;">
              <img class="image_menu"
                  src="data:image/png;base64,<?php echo base64_encode(file_get_contents($row['categorieImage'])) ?>">
              <div class="card-body menu_detail">
                  <h5 class="card-title badge  text-wrap"><a href="viewMenuList.php?catid= <?php echo $id ?>"><?php echo $cat ?></a></h5>
                  <p class="card-text fst-italic "><?php echo substr($desc, 0, 25)?>.. </p>
                  <!-- <a href="viewMenuList.php?catid=<?php echo $id ?>" class="btn btn-primary">Mirar platos</a> -->
              </div>
      </div>
</div>
<?php }
   }
?>