 <?php
 include "classes/db2.class.php";
 include 'functions.php';
 $userid = $_SESSION['userid'];
if ($_FILES["file"]["type"] == "text/plain" && $_FILES["file"]["size"] < 65536) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    } else {
        if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"])) {
                $_SESSION['msg'] = 'fus';
                header("location:cellsitetech-configuration.php");
            }
        }
    }
} else {
    if ($_FILES["file"]["type"] != "text/plain")
        echo "File is not of the permitted type.";
    else if ($_FILES["file"]["size"] < 65536)
        echo "File exceeds permitted size.";
}
?> 