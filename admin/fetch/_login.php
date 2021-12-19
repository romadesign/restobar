<?php include_once('db/dbconnect.php') ?>

<?php
function login(){
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db/dbconnect.php';
    
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    
    $sql = "Select * from users where username='$username'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row=mysqli_fetch_assoc($result);
        $userType = $row['userType'];
        if($userType == 1) {
            $userId = $row['id'];
            if (password_verify($password, $row['password'])){ 
                session_start();
                $_SESSION['adminloggedin'] = true;
                $_SESSION['adminusername'] = $username;
                $_SESSION['adminuserId'] = $userId;
                header("Location: ../admin/index.php");
                exit();
            } 
            else{
                header("Location: ../admin/login.php?loginincorrectsuccess=false");
            }
        }
        else {
            header("Location: ../admin/login.php?loginsuccess=false");
        }
    } 
    else{
        header("Location: ../admin/login.php?loginwarning=false");
    }
} 
}
?>