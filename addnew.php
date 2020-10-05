<?php
session_start();
	$status1="";
	if(isset($_POST['upload1'])){
		$department = $_SESSION['dept'];
		$ssn = $_SESSION['ssn'];
		$type = $_POST['type'];
		$tol = $_POST['tol'];
		$pi = $_POST['pi'];
		$year = $_POST['year'];
		$sd = $_POST['sd'];
		$ed = $_POST['ed'];
		$nol = $_POST['nol'];
		$tsr = $_POST['tsr'];
		$conn = mysqli_connect("localhost","root","","staff_info");
		if (mysqli_connect_error()){
			echo "can't connect to database";
		}
		else{
			if($tsr !== ""){
				$submit_query = "UPDATE `$department` SET `TYPE`='$type',`title_of_linkage`='$tol',`participating_institute`='$pi',`year`=$year,`start_date`='$sd',`end_date`='$ed',`nature_of_linkage`='$nol' WHERE `sr.`=$tsr";

			}
			else{
				$submit_query = "INSERT INTO `$department`(`ssn`, `TYPE`, `title_of_linkage`, `participating_institute`, `year`, `start_date`, `end_date`, `nature_of_linkage`) VALUES ('$ssn','$type','$tol','$pi','$year','$sd','$ed','$nol');";
			}
			if(mysqli_query($conn, $submit_query)){
				$status1 = "success";
			} else {
				$status1 = "fail";
			}
		}
	}
	$type="";
	$tol="";
	$pi="";
	$year="";
	$sd="";
	$ed="";
	$nol="";
	$tsr="";
	if(isset($_POST['update'])){
		$dept = $_POST['sdept'];
		$tsr = $_POST['tsr'];
		$table_query = "SELECT * FROM `$dept` WHERE `sr.`=$tsr;";
		$conn = mysqli_connect("localhost","root","","staff_info");
		if (mysqli_connect_error()){
			echo "can't connect to database";
		}
		else{
			$table = mysqli_query($conn, $table_query);
			while($row = $table->fetch_array()){
				$type = $row['TYPE'];
				$tol = $row['title_of_linkage'];
				$pi = $row['participating_institute'];
				$year = $row['year'];
				$sd = $row['start_date'];
				$ed = $row['end_date'];
				$nol = $row['nature_of_linkage'];
			}
		}
	}

	

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Staff Activity </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/datastyle.css">
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/form1.js"></script>
</head>


<body>
<header style="background-color: turquoise;">
		<nav id="header">
            <div class="header_logo">
              <a href="https://www.vcet.edu.in/">
                <div id="logo-img"></div>
              </a>
            </div>
              <div class="header_name">
                <a href="https://www.vcet.edu.in/"><h1>Vidyavardhini's College Of Engineering & Technology</h1></a>
                <p>विद्यावर्धिनीचे अभियांत्रिकी आणि तंत्रज्ञान महाविद्यालय, वसई</p>
              </div>
		</nav>
	</header>
	<div id="main">
		<div id="data_in">
			<div id="exist" class="form">
				<form id="existf" method="post">
					<fieldset>
						<legend>Select staff:</legend>
						<div class="container">
						<div>
							<label for="select_dept">Select Department:<sup class="red">*</sup></label><br>
							<input type="text" id="select_dept" name="sdept" value="<?php echo $_SESSION['dept']?> Department" disabled>

						</div>
						<div>
							<label for="select_staff">Staff:<sup class="red">*</sup></label><br>
							<input type="text" id="select_staff" name="sstaff" value="<?php echo $_SESSION['name']?>" disabled>
						</div>
						</div>
						<div id="information">
						
						</div>
						<div id="try"></div>
					</fieldset>
					<fieldset>
						<legend>Add New Program:</legend>
						<div class="container">
							<div id="select_type">
								<label for="select_type">Program type:<sup class="red">*</sup></label><br>
								<input class="type" type="radio" id="FDP" style="margin-left: 0;" name="type" value="FDP" <?php echo ($type == 'FDP')? "checked" : ""; ?> required >
								<label class="type" for="FDP">FDP</label>
								<input class="type" type="radio" id="STTP" name="type" value="STTP" <?php echo ($type == 'STTP')? "checked" : ""; ?> required>
								<label class="type" for="STTP">STTP</label>
								<input class="type" type="radio" id="Workshop" name="type" value="Wrokshop" <?php echo ($type == 'Workshop')? "checked" : ""; ?> required >
								<label class="type" for="Workshop">Workshop</label>
							</div>
							<div id="select_tol">
								<div>
								<label for="tol">Title of linkage:<sup class="red">*</sup></label><br>
								<input type="text" id="tol" name="tol" placeholder="Title of linkage" value="<?php echo ($tol !== '')? $tol : ''; ?>" required >
								</div>
								<div>
								<label for="pi">Participating Institute:<sup class="red">*</sup></label><br>
								<input type="text" id="pi" name="pi" placeholder="Participating institute" value="<?php echo ($pi !== '')? $pi : ''; ?>" required >
								</div>
							</div>
							<div id="select_duration">
								<div>
								<label for="sd">Start date:<sup class="red">*</sup></label><br>
								<input type="date" id="sd" name="sd" value="<?php echo ($sd !== '')? $sd : ''; ?>" required>
								</div>
								<div>
								<label for="ed">End date:<sup class="red">*</sup></label><br>
								<input type="date" id="ed" name="ed" value="<?php echo ($ed !== '')? $ed : ''; ?>" required>
								</div>
							</div>
							<div id="select_nol">
								<div>
								<label for="year">Year:<sup class="red">*</sup></label><br>
								<select id="year" name="year" required ></select>
								</div>
								<div>
								<label for="nol">Nature of linkage:<sup class="red">*</sup></label><br>
								<input type="text" id="nol" name="nol" placeholder="Nature of linkage" value="<?php echo ($nol !== '')? $nol : ''; ?>" required>
								<input type="hidden" name="tsr" value="<?php echo $tsr?>">	
							</div>
							</div>
					</fieldset>
					<div id="submit">
					<input type="submit" id="upload" name="upload1" value="Upload" form="existf">
					<p id="status">
						<?php
							if($status1 == "success"){
								echo '<script>
								alert("New record created successfully");
								location.href="add_program.php";
								</script>';
							} else if($status1 == "fail") {
								echo '<script>
								alert("Error while uploading data");
								location.href="add_program.php";
								</script>';
							}
						?>
					</p>
					</div>
				</form> 
			</div>
		</div>
	</div>
</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
	}
	var preyear = "<?php echo ($year !== '')? $year : ''; ?>";
	console.log(preyear);
	
</script>
</html>
