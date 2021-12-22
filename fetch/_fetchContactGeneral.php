<?php 
include '_dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];

    if (isset($_POST['removeMessage'])) {
        include_once('../db/dbconnect.php');
        $contactId = $_POST["contactId"];
        $sql = "DELETE FROM contactreply WHERE contactId='$contactId' AND userId='$userId'";   
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

?>