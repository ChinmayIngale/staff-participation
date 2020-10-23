<?php
require_once('pdo.php');

if(isset($_POST["table"]) && isset($_POST["row"]) ){
    $table = $_POST["table"];
    $row = $_POST["row"];

    $delete_query = "DELETE FROM `$table` WHERE `sr.`= :row";
    $stmt = $pdo->prepare($delete_query);
    $status = $stmt->execute(array(
            ':row' => $row)
        );
        
    if($status){
        echo "deleted Successfully";
    }
    else{
        echo "error";
    }
}
?>
