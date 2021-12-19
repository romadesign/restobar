
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['removeItem'])) {
        include_once('../db/dbconnect.php');

        $pizzaId = $_POST["pizzaId"];
        $sql = "DELETE FROM `pizza` WHERE `pizzaId`='$pizzaId'";
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
        $pizzaName = $_POST["pizzaName"];
        $pizzaDesc = $_POST["pizzaDesc"];
        $pizzaCategorieId = $_POST["pizzaCategorieId"];
        $pizzaPrice = $_POST["pizzaPrice"];
        $pizzaDesc = $_POST["pizzaDesc"];
        $pizzaImage = $_FILES['pizzaImage']['tmp_name'];
        $pizzaImageType = pathinfo($pizzaImage, PATHINFO_EXTENSION);    

        $datainage = file_get_contents($pizzaImage);
        $img_base64 = base64_encode($datainage);
        $img = 'data:image/' . $pizzaImageType . ';base64,' . $img_base64;

        $query = "INSERT INTO pizza (pizzaName, pizzaPrice, pizzaDesc, pizzaCategorieId, pizzaImage) VALUES ('$pizzaName', '$pizzaPrice','$pizzaDesc', '$pizzaCategorieId', '$img')";
        $resultado = mysqli_query($conn, $query);

        header("Location: ../admin/index.php");
        exit();
    }
}

function updatePizza()
{
    include('db/dbconnect.php');
    if(isset($_GET['id'])){
        $pizzaId = $_GET["id"];
        $sql = "SELECT * FROM pizza WHERE pizzaId = $pizzaId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        //Otra forma de poner directamente en los value 
        // $row->description;
        
    }

    if(isset($_POST['update'])){
        $pizzaId = $_GET["id"];
        $pizzaName = $_POST["pizzaName"];
        $pizzaPrice = $_POST["pizzaPrice"];
        $pizzaCategorieId = $_POST["pizzaCategorieId"];
        $pizzaDesc = $_POST["pizzaDesc"];
        $pizzaImage = $_FILES['pizzaImage']['tmp_name'];
        $pizzaImageType = pathinfo($pizzaImage, PATHINFO_EXTENSION);    

        $datainage = file_get_contents($pizzaImage);
        $img_base64 = base64_encode($datainage);
        $img = 'data:image/' . $pizzaImageType . ';base64,' . $img_base64;
        $sql = "UPDATE pizza set pizzaName = '$pizzaName', pizzaDesc = '$pizzaDesc',pizzaCategorieId = '$pizzaCategorieId', pizzaPrice = '$pizzaPrice', pizzaImage = '$img' WHERE pizzaId = $pizzaId";
        $result = $conn->query($sql);
        header("Location: ../admin/index.php?page=menuManage");


    } ?>
        <div class="form-content">
         <h2 class="mt-3">Edit Menú where Id <?php echo $_GET['id']; ?></h2>
        <form action="menuManageUpdate.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-6">
                    <div class="mb-3">
                            <label for="pizzaName" class="form-label">Description</label>
                            <input class="form-control" type="text" name="pizzaName" id="pizzaName" value="<?php echo $row['pizzaName']?>"autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="pizzaDesc" class="form-label">Description</label>
                            <textarea class="form-control" type="text" name="pizzaDesc" id="pizzaDesc" autofocus><?php echo $row['pizzaDesc']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pizzaPrice" class="form-label">Price</label> 
                            <div class="input-group">
                                <input type="text" name="pizzaPrice" id="pizzaPrice" value="<?php echo $row['pizzaPrice'] ?>" autofocus class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="input-group-text">$</span>
                                <span class="input-group-text">0.00</span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                                    <select name="pizzaCategorieId" id="pizzaCategorieId" class="form-select"  required>
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
                    <input type="file" name="pizzaImage" id="pizzaImage" accept=".jpg" class="form-control" required style="border:none;">
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

