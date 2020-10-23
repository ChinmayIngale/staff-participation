<?php
	session_start();
	require_once('pdo.php');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	if ( !isset($_SESSION['uname']) && $_SESSION['user'] == 'staff') {
        die('ACCESS DENIED');
    }

    $ssn = $_SESSION['ssn'];
    $_SESSION['user'] = 'staff';
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
				<button id="index">Log out</button>
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
            
            <div id="bio">
                <div id="info_parent">
                    <div id="staffinfo">
                        <div id="staffname">
                            <h3><?=htmlentities($name)?></h3>
                        </div>
                        <div id="staffdes"><?=htmlentities($info)?></div>
                    </div>
                    <div id="staffpic">
                        <div>
                            <img src="showimg.php?ssn=<?=htmlentities($ssn)?>" width="200" height="200">
                        </div>
                    </div>
                </div>
            </div>
            <div id="table">
                <table class="info">
                    <thead>
                        <tr class="data_tr">
                            <th class="data_th" rowspan="2">SR. No</th>
                            <th class="data_th" rowspan="2">Type</th>
                            <th class="data_th" rowspan="2">Title</th>
                            <th class="data_th" rowspan="2">Organizing Agency</th>
                            <th class="data_th" rowspan="2">Year</th>
                            <th class="data_th" colspan="2">Duration</th>
                            <th class="data_th" rowspan="2">Name of Program</th>
                            <th class="data_th" rowspan="2">Operation</th>
                        </tr>
                        <tr class="data_tr">
                            <th class="data_th">start date</th>
                            <th class="data_th">end date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sr = 1;
                    $table_query = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$dept` WHERE ssn= :ssn ORDER BY TYPE, start_date";
                    $stmt = $pdo->prepare($table_query);
                    $stmt->execute(array(
                            ':ssn' => $ssn)
                        );
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach( $rows as $row ) {
                        $tsr= $row['sr.'];
                        $ssn = $row['ssn'];
                        $type = $row['TYPE'];
                        $tol = $row['title_of_linkage'];
                        $pi = $row['participating_institute'];
                        $year = $row['year'];
                        $sd = $row['sd'];
                        $ed = $row['ed'];
                        $nol = $row['nature_of_linkage'];

                        echo '<tr class="data_tr">
                                <td class="data_td">'.$sr.'</td>
                                <td class="data_td">'.htmlentities($type).'</td>
                                <td class="data_td">'.htmlentities($tol).'</td>
                                <td class="data_td">'.htmlentities($pi).'</td>
                                <td class="data_td">'.htmlentities($year).'</td>
                                <td class="data_td">'.htmlentities($sd).'</td>
                                <td class="data_td">'.htmlentities($ed).'</td>
                                <td class="data_td">'.htmlentities($nol).'</td>
                                <td class="data_td">
                                <form class="deletef">
                                    <button class="operation del" form="deletef" onClick="deleteInfo(`'.htmlentities($dept).'`,'.htmlentities($tsr).')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                </form>
                                <button name="update" form="existf" class="operation update" onClick="modifyInfo(`'.htmlentities($dept).'`,'.htmlentities($tsr).')"><i class="fa fa-pencil" aria-hidden="true"></i> Modify</button>
                                </td>
                                </tr>';
                        $sr++; 
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div id="submit">
            <button id="newprg" name="newprg" form="existf" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add new program</button>
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
    deleteInfo = function(dept,sr){
        console.log(dept);
        $.ajax({
            url:"delete.php",
            method:"post",
            data:{"table":dept,"row": sr}
        }).done(function(data){
            document.querySelector("#try").innerHTML= data;
            location.href="staffdata.php";
        })
    }

    modifyInfo = function(dept,sr){
        document.querySelector("#tsr").value=sr;
        console.log(sr);
    }
    document.querySelector("#index").addEventListener('click', function(){
    location.href="logout.php";
});
</script>
</html>