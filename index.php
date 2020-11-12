<?php
    require_once('pdo.php');

    if(isset($_GET["search"])){
        $serach = $_GET['search'];
        $sql="SELECT * FROM `staff` WHERE S_name LIKE '%$serach%'";
    }
    else{
        $sql="SELECT * FROM `staff` ORDER BY `S_post` DESC";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Activity</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery-3.5.1.min.js"></script>
</head>
<body>
    <header>
    <nav id="header">
			<div id="name">
            <div class="header_logo">
              <a href="index.php">
                <div id="logo-img"></div>
              </a>
            </div>
              <div class="header_name">
                <a href="index.php"><h1>Vidyavardhini's College Of Engineering & Technology</h1></a>
                <p>विद्यावर्धिनीचे अभियांत्रिकी आणि तंत्रज्ञान महाविद्यालय, वसई</p>
			  </div>
			</div>
			<div class="right_btn">
				<a href="login_page.php"><button id="login_page" >Login</button></a>
			</div>
		</nav>
    </header>
    <div class="img" style="height: 400px;">
        <div class="overlay">
            <div class="heading">
                <div class="res"><h2 id="staffacivity">Staff Activity</h2></div>
                <div class="break"></div>
                <span id="line"></span>
            </div>
        </div>
    </div>
    <div id="main">
        <div id="sidenav">
            <p data-dept="Mechanical" class="dept_select" >MECHANICAL ENGINEERING</p>
            <p data-dept="Electronics And Telecommunications" class="dept_select" >ELECTRONICS & TELECOMMUNICATIONS ENGINEERING</p>
            <p data-dept="Instrumentation" class="dept_select" >INSTRUMENTATION ENGINEERING</p>
            <p data-dept="Computer" class="dept_select" >COMPUTER ENGINEERING</p>
            <p data-dept="Information Technology" class="dept_select" >INFORMATION TECHNOLOGY</p>
            <p data-dept="Civil" class="dept_select" >CIVIL ENGINEERING</p>
        
        </div>
        <div id="list">
            <div>
                <form>
                    <input id="search" type="text" name="search" placeholder="Search Staff ..">
                </form>
            </div>
            <div class="box">
            <select onchange="stafflist(this.value)">
                <option hidden>--Select Department--</option>
                <option value="Mechanical">Mechanical Engineering</option>
                <option value="Electronics And Telecommunications">Electronics & Telecommunications Engineering</option>
                <option value="Instrumentation">Instrumentation Engineering</option>
                <option value="Computer">Computer Engineering</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Civil">Civil Engineering</option>
            </select>
            </div>
            <div id="stafflist">
                <?php
                    foreach( $rows as $row ) {
                        $ssn = $row['ssn'];
                        $sname = $row['S_name'];
                        $spost = $row['S_post'];
                        $semail = $row['S_email'];
                        echo '<div class="card"><a href="staffinfo.php?ssn='.htmlentities($ssn).'" target="_blank">
                                <div class="image">
                                    <img src="showimg.php?ssn='.htmlentities($ssn).'">
                                </div>
                                <div class="title">
                                   <h3 class="teacher_name">'.htmlentities($sname).'</h3>
                                </div>
                                <div class="des">
                                    <p >'.htmlentities(strtoupper($spost)).'<br>'.htmlentities($semail).'</p>
                                </div>
                                </a></div>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="js/index.js"></script>
</html>