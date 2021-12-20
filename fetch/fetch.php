<?php 
function categorieGet()
{
  include('db/dbconnect.php');
  $sql = "SELECT categorieName, categorieId FROM categories"; 
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    echo '<a class="dropdown-item" href="viewPizzaList.php?catid=' .$row['categorieId']. '">' .$row['categorieName']. '</a>';
  }
}
?>

<?php 
function viewcart()
{
  if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    include('db/dbconnect.php');
    $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
    
    $countresult = mysqli_query($conn, $countsql);
    $countrow = mysqli_fetch_assoc($countresult);      
    $count = $countrow['SUM(`itemQuantity`)'];
    if(!$count) {
      $count = 0;
    }else{ ?>
<button type="button" class="btn btn-warning mx-2" title="MyCart">
    <svg xmlns="img/cart.svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
        <path
            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </svg>
    <i class="bi bi-cart"><?php echo $userId ?></i>
</button>
<?php }
  }
} ?>