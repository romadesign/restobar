<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['removeUser'])) {
        include_once('../db/dbconnect.php');

        $id = $_POST["id"];
        $sql = "DELETE FROM  users WHERE id   ='$id'";
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

function createUser()
{
    include('db/dbconnect.php');
    if (isset($_POST['createUser'])) {
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $userType = $_POST["userType"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        // Check whether this username exists
        $existSql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Username Already Exists');
                    window.location=document.referrer;
                </script>";
        }else{
            if(($password == $cpassword)){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` ( `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '$userType', '$hash', current_timestamp())";   
                $result = mysqli_query($conn, $sql);
                if ($result){
                    echo "<script>alert('Success');
                            window.location=document.referrer;
                        </script>";
                }else {
                    echo "<script>alert('Failed');
                            window.location=document.referrer;
                        </script>";
                }
            }
            else{
                echo "<script>alert('Passwords do not match');
                    window.location=document.referrer;
                </script>";
            }
        }
    }
}
?>

<?php
function updateUser()
{
    include('db/dbconnect.php');
    if(isset($_GET['id'])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }

    if(isset($_POST['updateUser'])){
        $id = $_GET["id"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $userType = $_POST["userType"];

        $sql = "UPDATE `users` SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', userType='$userType' WHERE id='$id'";   
        $result = mysqli_query($conn, $sql);
        header("Location: ../admin/index.php?page=userManage");
    } ?>
        <div class="form-content">
         <h2 class="mt-3">Edit user where Id <?php echo $_GET['id']; ?></h2>
        <form action="userManageUpdate.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="row">
            <div class="col-md-6">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">firstName</label>
                            <input class="form-control" type="text" name="firstName" id="firstName" value="<?php echo $row['firstName']?>"autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">lastName</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $row['lastName']?>"autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo $row['email']?>"autofocus>
                        </div>
                        <div class="row">
                        <div class="col-md-6 my-0">
                                <b><label for="phone">Celular:</label></b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon">+64</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="<?php echo $row['phone']?>" required  maxlength="9">
                                </div>
                            </div>
                            <div class="col-md-6 my-0">
                                <b><label for="userType">Type:</label></b>
                                <select name="userType" id="userType" class="custom-select browser-default" required>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>      
            </div>
            <div class="col-md-6">
                <!-- <div class="form-group">
                    <label for="image" class="control-label">Remplazar muy pronto</label>
                    <input type="file" name="categorieImage" id="categorieImage" accept=".jpg" class="form-control" required style="border:none;">
                    <small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
                </div> -->
                <div class="d-flex">
                    <button type="submit" name="updateUser" class="btn btn-success w-100  m-1">Save</button>
                    <button type="button" class="btn btn-danger w-100  m-1"><a href="index.php">Cancel</a></button>
                </div>
            </div>
            </div>
        </form>
    </div>
<?php 

} ?>