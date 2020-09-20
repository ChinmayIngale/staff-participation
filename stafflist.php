
<?php
if(isset($_GET["search"])){
    $serach = $_GET['search'];
    $sql="SELECT * FROM `staff` WHERE S_name LIKE '%$serach%'";
}
else{
    if($dept == "All Staff"){
        $sql="SELECT * FROM `staff` ORDER BY `S_post` DESC";
    }
    else{
        $sql ="SELECT * FROM `staff` WHERE dept='$dept'";
    }
}
//echo $sql;
$conn = mysqli_connect("localhost","root","","staff_info");
if (mysqli_connect_error()){
    echo "can't connect to database";
}
else{
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_array()){
        $ssn = $row['ssn'];
        $sname = $row['S_name'];
        $spost = $row['S_post'];
        $semail = $row['S_email'];
        echo '<div class="card"><a href="pg2.php?ssn='.$ssn.'" target="_blank">
                <div class="image">
                    <img src="showimg.php?ssn='.$ssn.'">
                </div>
                <div class="title">
                   <h3 class="teacher_name">'.$sname.'</h3>
                </div>
                <div class="des">
                    <p >'.strtoupper($spost).' '.$semail.'</p>
                </div>
                </a></div>';
    }
    
};

?>
