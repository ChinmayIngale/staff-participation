<?php


if(isset($_POST["table"]) && isset($_POST["row"]) ){
    $conn = mysqli_connect("localhost","root","","staff_info");
    if (mysqli_connect_error()){
        echo "can't connect to database";
    }
    else{
        $table = $_POST["table"];
        $row = $_POST["row"];

        $delete_query = "DELETE FROM `$table` WHERE `sr.`=$row;";
        
        if(mysqli_query($conn,$delete_query)){
            echo "deleted Successfully";
        }
        else{
            echo "error";
        }
        
    }
}
?>
