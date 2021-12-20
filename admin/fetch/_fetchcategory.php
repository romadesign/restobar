<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['remove'])) {
        include_once('../db/dbconnect.php');

        $categorieId = $_POST["categorieId"];
        $sql = "DELETE FROM  categories WHERE categorieId   ='$categorieId'";
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


function createCategory()

{
    include('db/dbconnect.php');
    if (isset($_POST['createCategorie'])) {
        $categorieName = $_POST["categorieName"];
        $categorieDesc = $_POST["categorieDesc"];
        $categorieImage = $_FILES['categorieImage']['tmp_name'];
        $categorieImageType = pathinfo($categorieImage, PATHINFO_EXTENSION);    

        $datainage = file_get_contents($categorieImage);
        $img_base64 = base64_encode($datainage);
        $img = 'data:image/' . $categorieImageType . ';base64,' . $img_base64;

        $query = "INSERT INTO categories (categorieName,categorieDesc, categorieImage) VALUES ('$categorieName', '$categorieDesc','$img')";
        $resultado = mysqli_query($conn, $query);

        header("Refresh:1");

        exit();
    }
}

?>

<?php
function updateCategorie()
{
    include('db/dbconnect.php');
    if(isset($_GET['id'])){
        $categorieId = $_GET["id"];
        $sql = "SELECT * FROM categories WHERE categorieId = $categorieId";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    
        //Otra forma de poner directamente en los value 
        // $row->description;
        
    }

    if(isset($_POST['update'])){
        $categorieId = $_GET["id"];
        $categorieName = $_POST["categorieName"];
        $categorieDesc = $_POST["categorieDesc"];
        $categorieImage = $_FILES['categorieImage']['tmp_name'];
        $categorieImageType = pathinfo($categorieImage, PATHINFO_EXTENSION);    

        $datainage = file_get_contents($categorieImage);
        $img_base64 = base64_encode($datainage);
        $img = 'data:image/' . $categorieImageType . ';base64,' . $img_base64;
        $sql = "UPDATE categories set categorieName = '$categorieName', categorieDesc = '$categorieDesc', categorieImage = '$img' WHERE categorieId = $categorieId";
        $result = $conn->query($sql);
        header("Location: ../admin/index.php?page=categoryManage");



    } ?>
<div class="form-content">
    <h2 class="mt-3">Edit categorie where Id <?php echo $_GET['id']; ?></h2>
    <form action="categorieManageUpdate.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="categorieName" class="form-label">Description</label>
                    <input class="form-control" type="text" name="categorieName" id="categorieName"
                        value="<?php echo $row['categorieName']?>" autofocus>
                </div>
                <div class="mb-3">
                    <label for="categorieDesc" class="form-label">Description</label>
                    <textarea class="form-control" type="text" name="categorieDesc" id="categorieDesc"
                        autofocus><?php echo $row['categorieDesc']?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image" class="control-label">Remplazar</label>
                    <input type="file" name="categorieImage" id="categorieImage" accept=".jpg" class="form-control"
                        required style="border:none;">
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