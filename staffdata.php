<?php
	session_start();
	require_once('pdo.php');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	if ( !isset($_SESSION['uname']) || $_SESSION['user'] == 'admin'){
            die('ACCESS DENIED');
        
    }

    $ssn = $_SESSION['ssn'];
    $data_query = "SELECT * FROM `staff` WHERE `ssn`= :ssn";
    $stmt = $pdo->prepare($data_query);
    $stmt->execute(array(
            ':ssn' => $ssn)
        );
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $row['S_name'];
    $info = $row['S_info'];
    $ssn = $row['ssn'];
    $dept = $row['dept'];
    $deptlower = strtolower($row['dept']);
    
    $_SESSION['name'] = $name; 
    $_SESSION['dept'] = $dept;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Staff Activity </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/datastyle.css">

<script src="js/jquery-3.5.1.min.js"></script>
</head>

<body>
	<header style="background-color: turquoise;">
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
				<a href="logout.php"><button id="index">Log out</button></a>
			</div>
		</nav>
	</header>
	<div id="main">
	<div id="data_in" style="margin: 50px auto;">
		<div id="exist" class="form">
			<form id="existf" method="post" action="addnew.php">
					
			<input type="hidden" id="tsr" name="tsr">
			<input type="hidden" id="dept" name="dept" value="<?= $_SESSION['dept']?>">
					
            </form> 
            <div id="information">
           
            </div>
            <div id="try"></div>
			
		</div>
		
	</div>
	</div>
</body>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    document.addEventListener("DOMContentLoaded", () => {
        
        function staffdata(){
            var ssn = <?= $ssn?>;
            console.log('fhff');
            $.ajax({
                url:"getbackenddata.php",
                method:"post",
                data:"ssn=" + ssn
            }).done(function(sname){
                document.querySelector("#information").innerHTML= sname;
            });
        }   

        staffdata();
        deleteInfo = function(dept,sr){
            console.log(dept);
            $.ajax({
                url:"delete.php",
                method:"post",
                data:{"table":dept,"row": sr}
            }).done(function(data){
                document.querySelector("#try").innerHTML= data;
                staffdata();
            })
        }

        modifyInfo = function(dept,sr){
            document.querySelector("#tsr").value=sr;
            console.log(sr);
        }
    });
</script>
</html>