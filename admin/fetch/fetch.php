
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['removeItem'])) {
        include_once('../db/dbconnect.php');

        $menuId = $_POST["menuId"];
        $sql = "DELETE FROM `menu` WHERE `menuId`='$menuId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {

            echo "<script>alert('Removed');
                    window.location=document.referrer;
                </script>";
        } else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
}

function createPizza()
{
    include('db/dbconnect.php');
    if (isset($_POST['createItem'])) {
        $menuName = $_POST["menuName"];
        $menuCategorieId = $_POST["menuCategorieId"];
        $menuPrice = $_POST["menuPrice"];
        $menuDesc = $_POST["menuDesc"];
        $menuImage = $_FILES['menuImage']['tmp_name'];
        $menuImageType = pathinfo($menuImage, PATHINFO_EXTENSION);    

        $datainage = file_get_contents($menuImage);
        $img_base64 = base64_encode($datainage);
        $img = 'data:image/' . $menuImageType . ';base64,' . $img_base64;

        $query = "INSERT INTO menu (menuName, menuPrice, menuDesc, menuCategorieId, menuImage) VALUES ('$menuName', '$menuPrice','$menuDesc', '$menuCategorieId', '$img')";
        $resultado = mysqli_query($conn, $query);

        header("Location: ../admin/index.php");
        exit();
    }
}

function updatePizza()
{
    include('db/dbconnect.php');
    if(isset($_GET['id'])){
        $menuId = $_GET["id"];
        $sql = "SELECT * FROM menu WHERE menuId = $menuId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        //Otra forma de poner directamente en los value 
        // $row->description;
        
    }

    if(isset($_POST['update'])){
        $menuId = $_GET["id"];
        $menuName = $_POST["menuName"];
        $menuPrice = $_POST["menuPrice"];
        $menuCategorieId = $_POST["menuCategorieId"];
        $menuDesc = $_POST["menuDesc"];
        $menuImage = $_FILES['menuImage']['tmp_name'];
        $menuImageType = pathinfo($menuImage, PATHINFO_EXTENSION);    

        $datainage = file_get_contents($menuImage);
        $img_base64 = base64_encode($datainage);
        $img = 'data:image/' . $menuImageType . ';base64,' . $img_base64;
        $sql = "UPDATE menu set menuName = '$menuName', menuDesc = '$menuDesc',menuCategorieId = '$menuCategorieId', menuPrice = '$menuPrice', menuImage = '$img' WHERE menuId =' $menuId'";
        $result = $conn->query($sql);
        header("Location: ../admin/index.php?page=menuManage");


    } ?>
        <div class="form-content">
         <h2 class="mt-3">Edit Menú where Id <?php echo $_GET['id']; ?></h2>
        <form action="menuManageUpdate.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-6">
                    <div class="mb-3">
                            <label for="menuName" class="form-label">Description</label>
                            <input class="form-control" type="text" name="menuName" id="menuName" value="<?php echo $row['menuName']?>"autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="menuDesc" class="form-label">Description</label>
                            <textarea class="form-control" type="text" name="menuDesc" id="menuDesc" autofocus><?php echo $row['menuDesc']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="menuPrice" class="form-label">Price</label> 
                            <div class="input-group">
                                <input type="text" name="menuPrice" id="menuPrice" value="<?php echo $row['menuPrice'] ?>" autofocus class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="input-group-text">$</span>
                                <span class="input-group-text">0.00</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                                    <select name="menuCategorieId" id="menuCategorieId" class="form-select"  required>
                                        <option hidden disabled selected value>Select category</option>
                                        <?php
                                        $catsql = "SELECT * FROM `categories`";
                                        $catresult = mysqli_query($conn, $catsql);
                                        while ($row = mysqli_fetch_assoc($catresult)) {
                                            $catId = $row['categorieId'];
                                            $catName = $row['categorieName'];
                                            echo '<option value="' . $catId . '">' . $catName . '</option>';
                                        }
                                        ?>
                                    </select>
						</div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image" class="control-label">Remplazar</label>
                    <input type="file" name="menuImage" id="menuImage" accept=".jpg" class="form-control" required style="border:none;">
                    <small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
                </div>
                <div class="d-flex">
                    <button type="submit" name="update" class="btn btn-success w-100  m-1">Save</button>
                    <button type="button" class="btn btn-danger w-100  m-1"><a href="index.php">Cancel</a></button>
                </div>
            </div>
            </div>
        </form>
    </div>
<?php 

} ?>

