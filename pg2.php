<?php
$guess=$_GET['ssn']??NULL;
$sql = "SELECT * FROM staff WHERE ssn=$guess;";
$conn = mysqli_connect("localhost","root","","staff_info");
if (mysqli_connect_error()){
    echo "can't connect to database";
}
else{
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_array()){
        $ssn = $row['ssn'];
        $sname = $row['S_name'];
        $sinfo = $row['S_info'];
        $dept = $row['dept'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sname; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <nav id="header">
            <div class="header_logo">
              <a href="https://www.vcet.edu.in/" class="pull-left">
                <div id="logo-img"></div>
              </a>
            </div>
              <div class="header_name">
                <a href="https://www.vcet.edu.in/"><h1>Vidyavardhini's College Of Engineering & Technology</h1></a>
                <p>विद्यावर्धिनीचे अभियांत्रिकी आणि तंत्रज्ञान महाविद्यालय, वसई</p>
              </div>
        </nav>
    
      </header>
    <div class="img">
        <div class="overlay">
            <div class="heading">
                <div class="res"><h2><?php echo $dept; ?> Department</h2></div>
                <div class="break"></div>
                <span id="line"></span>
            </div>
        </div>
    </div>
    <div class="staff">
        <div id="info_parent">
            <div id="staffinfo">
                <div id="staffname">
                    <h3><?php echo $sname; ?></h3>
                </div>
                <div id="staffdes"><?php echo $sinfo; ?> </div>
            </div>
            <div id="staffpic">
                <div><?php
                    echo '<img src="showimg.php?ssn='.$ssn.'" width="200" height="200">';
                    ?>
                </div>
        </div>
        </div>
    </div>
    <div class="activity_info">
        <div id="col1" >
            <ul class="list-hover-slide">
                <li class="btn active"><a href="#">About</a></li>
                <li class="btn"><a href="#">FDP</a></li>
                <li class="btn" ><a href="#">STTP</a></li>
                <li class="btn" ><a href="#">Workshops</a></li>
              </ul>
        </div>
        <div id="col2" >
          <?php //include("data.php"); ?> 
        </div>
    </div>
</body>
<script src="js/p2_logic.js"></script>
</html>