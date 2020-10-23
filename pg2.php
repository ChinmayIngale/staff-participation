<?php
    require_once('pdo.php');

    $ssn=$_GET['ssn']??NULL;
    $sql = "SELECT * FROM staff WHERE ssn= :ssn";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            ':ssn' => $ssn)
        );
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $ssn = $row['ssn'];
    $sname = $row['S_name'];
    $sinfo = $row['S_info'];
    $dept = $row['dept'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlentities($sname) ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <header>
    <nav id="header">
			<div id="name">
            <div class="header_logo">
              <a href="https://www.vcet.edu.in/">
                <div id="logo-img"></div>
              </a>
            </div>
              <div class="header_name">
                <a href="https://www.vcet.edu.in/"><h1>Vidyavardhini's College Of Engineering & Technology</h1></a>
                <p>विद्यावर्धिनीचे अभियांत्रिकी आणि तंत्रज्ञान महाविद्यालय, वसई</p>
			  </div>
			</div>
			<div class="right_btn">
				<button id="login_page">Log in</button>
			</div>
		</nav>
      </header>
    <div class="img">
        <div class="overlay">
            <div class="heading">
                <div class="res"><h2><?= htmlentities($dept) ?> Department</h2></div>
                <div class="break"></div>
                <span id="line"></span>
            </div>
        </div>
    </div>
    <div class="staff">
        <div id="info_parent">
            <div id="staffinfo">
                <div id="staffname">
                    <h3><?= htmlentities($sname) ?></h3>
                </div>
            <div id="staffdes"><?= htmlentities($sinfo) ?> </div>
        </div>
            <div id="staffpic">
                <div><?php
                    echo '<img src="showimg.php?ssn='.htmlentities($ssn).'" width="200" height="200">';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="activity_info">
        <div id="col1">
            <ul class="list-hover-slide">
                <li data-tab-target="#about" class="btn active"><a>About</a></li>
                <li data-tab-target="#fdp" class="btn"><a>FDP</a></li>
                <li data-tab-target="#sttp" class="btn" ><a>STTP</a></li>
                <li data-tab-target="#workshop" class="btn" ><a>Workshops</a></li>
              </ul>
        </div>
        <div class="box">
            <select name="type" id="type" onchange="change(this.value)">
                <option value="about">About</option>
                <option value="fdp">FDP</option>
                <option value="sttp">STTP</option>
                <option value="workshop">Workshop</option>
            </select>
        </div>
        <div id="col2" >
            <div id="data">
            <?php include("data.php"); ?> 
            </div>
        </div>
    </div>
</body>
<script src="js/p2_logic.js"></script>
</html>