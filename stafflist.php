
<?php
$sql ="SELECT * FROM `staff` WHERE dept='$dept'";
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
        echo '<div class="card">
                <div class="image">
                    <img src="showimg.php?ssn='.$ssn.'">
                </div>
                <div class="title">
                   <h3 class="teacher_name"><a href="pg2.php?ssn='.$ssn.'" target="_blank">'.$sname.'</a></h3>
                </div>
                <div class="des">
                    <p class="elementor-image-box-description">'.$spost.' '.$semail.'</p>
                </div>
            </div>';
    }
    
};

?>
