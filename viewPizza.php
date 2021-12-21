<?php include_once('templates/header.php') ?>
<?php include 'fetch/_dbconnect.php';?>
<?php require 'fetch/_nav.php' ?>

<div class="container my-4" id="cont">
    <div class="row jumbotron">
        <?php
            $pizzaId = $_GET['pizzaid'];
            $sql = "SELECT * FROM pizza WHERE pizzaId = $pizzaId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $pizzaName = $row['pizzaName'];
            $pizzaPrice = $row['pizzaPrice'];
            $pizzaDesc = $row['pizzaDesc'];
            $pizzaCategorieId = $row['pizzaCategorieId'];
            $pizzaImage = $row['pizzaImage'];
        ?>
        <script>
        document.getElementById("title").innerHTML = "<?php echo $pizzaName; ?>"
        </script>
        <div class="col-md-4">
            <img class="image_menu" src="data:image/png;base64,<?php echo base64_encode(file_get_contents($pizzaImage)) ?>">
        </div>
        <div class="col-md-8 my-4">
            <h3><?php echo $pizzaName ?></h3>
            <h5 style="color: #ff0000">Rs <?php echo $pizzaPrice ?></h5>
            <p class="mb-0"><?php echo $pizzaDesc ?></p>
            <?php
                if($loggedin){
                    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
                    $quaresult = mysqli_query($conn, $quaSql);
                    $quaExistRows = mysqli_num_rows($quaresult);
                    if($quaExistRows == 0) { ?>
            <form action="fetch/_manageCart.php" method="POST">
                <input type="hidden" name="itemId" value="'.$pizzaId. '">
                <button type="submit" name="addToCart" class="btn btn-primary my-2">Añadir</button>
                <?php  }else { ?>
                <a href="viewCart.php"><button class="btn btn-primary my-2">Ir al carrito</button></a>
                <?php  }
                }
                else{ ?>
                <button class="btn btn-primary my-2" data-toggle="modal" data-target="#loginModal">Añadir</button>
                <?php } ?>
            </form>
            <h6 class="my-1"> View </h6>
            <div class="mx-4">
                <a href="viewPizzaList.php?catid=<?php echo $pizzaCategorieId ?>" class="active text-dark">
                    <i class="fas fa-qrcode"></i>
                    <span>All Pizza</span>
                </a>
            </div>
            <div class="mx-4">
                <a href="index.php" class="active text-dark">
                    <i class="fas fa-qrcode"></i>
                    <span>All Category</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include_once('templates/footer.php') ?>