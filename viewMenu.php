<?php include_once('templates/header.php') ?>
<?php include './db/dbconnect.php';?>
<?php require 'fetch/_nav.php' ?>

<div class="container my-4" id="cont">
    <br><br>
    <div class="row jumbotron">
        <?php
        if(isset($_GET['menuid'])){
            $menuId = $_GET['menuid'];
            $sql = "SELECT * FROM menu WHERE menuId='$menuId'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $menuName = $row['menuName'];
            $menuPrice = $row['menuPrice'];
            $menuDesc = $row['menuDesc'];
            $menuCategorieId = $row['menuCategorieId'];
            $menuImage = $row['menuImage'];
        }
           
        ?>
        <script>
        document.getElementById("title").innerHTML = "<?php echo $menuName?>";
        </script>
        <div class="col-md-8">
            <img class="image_menu w-100" src="data:image/png;base64,<?php echo base64_encode(file_get_contents($menuImage)) ?>">
        </div>
        <div class="col-md-4 my-4">
            <h3><?php echo $menuName ?></h3>
            <h5 style="color: #ff0000"> <?php echo $menuPrice ?> €</h5>
            <p class="mb-0"><?php echo $menuDesc ?></p>
            <?php

        if($loggedin){
        $quaSql = "SELECT itemQuantity FROM viewcart WHERE menuId='$menuId' AND userId='$userId'";
        $quaresult = mysqli_query($conn, $quaSql);
        $quaExistRows = mysqli_num_rows($quaresult);
        if($quaExistRows == 0) {
        echo '<form action="fetch/_manageCart.php" method="POST">
            <input type="hidden" name="itemId" value="'.$menuId.'">
            <button type="submit" name="addToCart" class="btn btn-warning my-2"><i class="fas fa-shopping-cart"></i>Agregar a la cesta</button>';
            }else {
            echo '<a href="viewCart.php"><button class="btn btn-success my-2">Ir al carrito</button></a>';
            }
            }
            else{
            echo '<button class="btn btn-warning my-2" data-toggle="modal" data-target="#loginModal"><i class="fas fa-shopping-cart"></i>   Agregar a la cesta</button>';
            }
            echo '
        </form>
        <div class="mx-4">
            <a href="viewMenuList.php?catid='.$menuCategorieId.'" class="active text-dark">
                <i class="fas fa-qrcode"></i>
                <span>Más platos</span>
            </a>
        </div>
        <div class="mx-4">
            <a href="index.php" class="active text-dark">
                <i class="fas fa-qrcode"></i>
                <span>Todas las Categorias</span>
            </a>
        </div>
    </div>'
    ?>
        </div>
    </div>

    <?php include_once('templates/footer.php') ?>