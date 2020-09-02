<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Activity</title>
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
    <div class="img" style="height: 400px;">
        <div class="overlay">
            <div class="heading">
                <div class="res"><h2 style="font-size: 80px;">Staff Activity</h2></div>
                <div class="break"></div>
                <span id="line"></span>
            </div>
        </div>
    </div>
    <div id="main">
        <div id="sidenav">
            <?php
            if(isset($_GET['page'])){
                $dept=$_GET['page'];
            }
            else{
                $dept = "Mechanical Engineering";
            }
            ?>
            <a <?php if($dept == "Mechanical Engineering"){echo 'id="activedept"';}?> class="dept_select" href="index.php?page=Mechanical Engineering">MECHANICAL ENGINEERING</a>
            <a <?php if($dept == "Computer Engineering"){echo 'id="activedept"';}?> class="dept_select" href="index.php?page=Computer Engineering">COMPUTER ENGINEERING</a>
            <a <?php if($dept == "Information Technology"){echo 'id="activedept"';}?> class="dept_select" href="index.php?page=Information Technology">INFORMATION TECHNOLOGY</a>
            <a <?php if($dept == "CE"){echo 'id="activedept"';}?> class="dept_select" href="index.php?page=CE">CIVIL ENGINEERING</a>
        </div>
        <div id="list">
            <div>
                <form>
                    <input type="text" name="search" placeholder="Search Staff ..">
                </form>
            </div>
            <?php
            /*
            $doc = new DOMDocument();
            $doc->loadHTMLFile("index.php");
            $dept = $doc->getElementById('activedept')->textContent;
            echo $dept;*/
            
            include("stafflist.php");
            ?>
        </div>
    </div>
</body>
</html>