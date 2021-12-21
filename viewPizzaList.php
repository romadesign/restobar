<?php include_once('templates/header.php') ?>
<?php include('fetch/_dbconnect.php');?>
<?php require('fetch/_nav.php'); ?>
<?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `categories` WHERE categorieId = $id";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){
      $catname = $row['categorieName'];
      $catdesc = $row['categorieDesc'];
  }
?>
<!-- Pizza container starts here -->
<div class="container my-3" id="cont">
    <div class="col-lg-4 text-center bg-light my-3"
        style="margin:auto;border-top: 2px groove black;border-bottom: 2px groove black;">
        <h2 class="text-center"><span id="catTitle">Items</span></h2>
    </div>
    <div class="row">
        <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM pizza WHERE pizzaCategorieId = $id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $pizzaId = $row['pizzaId'];
                $pizzaName = $row['pizzaName'];
                $pizzaPrice = $row['pizzaPrice'];
                $pizzaDesc = $row['pizzaDesc'];
                $pizzaImage = $row['pizzaImage']; ?>

        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="card" style="width: 18rem;">
                <img class="image_menu"
                    src="data:image/png;base64,<?php echo base64_encode(file_get_contents($row['pizzaImage'])) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo substr($pizzaName, 0, 20) ?></h5>
                    <h6 style="color: #ff0000">Rs <?php echo $pizzaPrice ?></h6>
                    <p class="card-text"><?php echo substr($pizzaDesc, 0, 29) ?></p>
                    <div class="row justify-content-center">
                        <?php 
                            if($loggedin){
                                $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
                                $quaresult = mysqli_query($conn, $quaSql);
                                $quaExistRows = mysqli_num_rows($quaresult);
                                if($quaExistRows == 0) { ?>
                        <form action="fetch/_manageCart.php" method="POST">
                            <input type="hidden" name="itemId" value="<?php echo $pizzaId ?>">
                            <button type="submit" name="addToCart" class="btn btn-primary mx-2">Añadir</button>
                            <?php }else { ?>
                            <a href="viewCart.php"><button class="btn btn-primary mx-2">Ir al carrito</button></a>
                            <?php }
                                      }
                                      else{ ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#loginModal">
                                Añadir
                            </button>
                            <?php }  ?>
                        </form>
                        <a href="viewPizza.php?pizzaid=<?php echo $pizzaId ?>" class="mx-2">
                            <button class="btn btn-primary">Mirar producto</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        if($noResult) { ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">Lo sentimos En esta categoría No hay artículos disponibles.</p>
                <p class="lead"> Lo actualizaremos pronto.</p>
            </div>
        </div>
        <?php  }
        ?>
    </div>
</div>



<?php include_once('templates/footer.php') ?>

<script>
document.getElementById("title").innerHTML = "<?php echo $catname; ?>";
document.getElementById("catTitle").innerHTML = "<?php echo $catname; ?>";
</script>