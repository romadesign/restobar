<?php include_once('templates/header.php') ?>
<?php include('fetch/_dbconnect.php');?>
<?php require('fetch/_nav.php'); ?>
<?php
  $id = $_GET['catid'];
  $sql = "SELECT * FROM categories WHERE categorieId='$id'";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){
      $catname = $row['categorieName'];
      $catdesc = $row['categorieDesc'];
  }
?>
<!-- Pizza container starts here -->
<div class="container my-3" id="cont">
<br><br>
    <div class="col-lg-4 text-center bg-light my-3"
        style="margin:auto;border-top: 2px groove black;border-bottom: 2px groove black;">
        <h2 class="text-center"><span id="catTitle"><?php echo $catname ?></span></h2>
    </div>
    <div class="row">
        <?php
            $id = $_GET['catid'];
            $sql = "SELECT * FROM menu WHERE menuCategorieId='$id'";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $menuId = $row['menuId'];
                $menuName = $row['menuName'];
                $menuPrice = $row['menuPrice'];
                $menuDesc = $row['menuDesc'];
                $menuImage = $row['menuImage']; ?>

        <div class="col-md-4 p-2">
            <div class="card" style="width: 100%;">
                <img class="image_menu" src="data:image/png;base64,<?php echo base64_encode(file_get_contents($row['menuImage'])) ?>">
                <div class="card-body">
                    <h5 class="card-title text-wrap"><a href="viewMenu.php?menuid=<?php echo $menuId ?>"><?php echo substr($menuName, 0, 20) ?></a></h5>
                    <h6 style="color: #ff0000"><?php echo $menuPrice ?> €</h6>
                    <p class="card-text fst-italic"><?php echo substr($menuDesc, 0, 29) ?></p>
                    <div class="d-flex justify-content-center">
                        <?php 
                            if($loggedin){
                                $quaSql = "SELECT itemQuantity FROM viewcart WHERE menuId='$menuId' AND userId='$userId'";
                                $quaresult = mysqli_query($conn, $quaSql);
                                $quaExistRows = mysqli_num_rows($quaresult);
                                if($quaExistRows == 0) { ?>
                        <form action="fetch/_manageCart.php" method="POST">
                            <input type="hidden" name="itemId" value="<?php echo $menuId ?>">
                            <button type="submit" name="addToCart" class="btn mx-2 bg-warning text-dark">
                            <i class="fas fa-shopping-cart"></i>    
                            Añadir a la cesta</button>
                            <?php }else { ?>
                            <a href="viewCart.php"><button class="btn bg-success text-white mx-2">Ir al carrito</button></a>
                            <?php }
                                      }
                                      else{ ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#loginModal">
                                Añadir
                            </button>
                            <?php }  ?>
                        </form>
                        <a href="viewMenu.php?menuid=<?php echo $menuId ?>" class="mx-2">
                            <button class="btn bg-primary text-white"> <i class="far fa-eye"></i> Mirar plato</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php }
        if($noResult) { ?>
        <div class="jumbotron jumbotron-fluid">
            <a href="index.php"><< Regresar al inicio</a>
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