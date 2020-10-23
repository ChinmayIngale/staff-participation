<?php
    require_once('pdo.php');

    $ssn=$_GET['ssn']??NULL;
    $sql = "SELECT * FROM staff WHERE ssn= :ssn";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            ':ssn' => $ssn)
        );
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach( $rows as $row ) {
            $imgdata= $row['photo'];
        }

    header("content-type: image/*");
    echo $imgdata;
    
?>