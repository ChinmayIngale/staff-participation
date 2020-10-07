<?php

$guess=$_GET['ssn']??NULL;
$sql = "SELECT * FROM staff WHERE ssn=$guess;";
$conn = mysqli_connect("localhost","root","","roster");
if (mysqli_connect_error()){
    echo "can't connect to database";
}
else{
    /*
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "New record created successfully";
    }
    else{
        echo "<h1>error</h1>".mysqli_error($conn);
    };
    */
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_array()){
        $imgdata= $row['photo'];
    }
    header("content-type: image/PNG");
    echo $imgdata;
    
};


?>