<?php
	$status1="";
	if(isset($_POST['upload1'])){
		$department = $_POST['sdept'];
		$ssn = $_POST['sstaff'];
		$type = $_POST['type'];
		$tol = $_POST['tol'];
		$pi = $_POST['pi'];
		$year = $_POST['year'];
		$sd = $_POST['sd'];
		$ed = $_POST['ed'];
		$nol = $_POST['nol'];
		$conn = mysqli_connect("localhost","root","","staff_info");
		if (mysqli_connect_error()){
			echo "can't connect to database";
		}
		else{
			$submit_query = "INSERT INTO `$department`(`ssn`, `TYPE`, `title_of_linkage`, `participating_institute`, `year`, `start_date`, `end_date`, `nature_of_linkage`) VALUES ('$ssn','$type','$tol','$pi','$year','$sd','$ed','$nol');";
			if(mysqli_query($conn, $submit_query)){
				$status1 = "success";
			} else {
				$status1 = "fail";
			}
		}
	}

	$status2="";
	if(isset($_POST['upload2'])){
		$sname = $_POST['sname'];
		$designation = $_POST['designation'];
		$department = $_POST['department'];
		$image = addslashes(file_get_contents( $_FILES['image']['tmp_name']));
		$dob = $_POST['dob'];
		$doji = $_POST['doji'];
		$experiance = $_POST['experiance'];
		$qualification = $_POST['qualification'];
		if(trim($_POST['papers']) == ""){
			$papers = 'NULL';
		}else{
			$papers = "'".$_POST['papers']."'";
		}
		if(trim($_POST['books']) == ""){
			$books = 'NULL';
		}else{
			$books = "'".$_POST['books']."'";
		}
		$email = $_POST['email'];
		$info = $_POST['info'];
		if(trim($_POST['memberships']) == ""){
			$memberships = 'NULL';
		}else{
			$memberships = "'".$_POST['memberships']."'";
		}
		if(trim($_POST['awards']) == ""){
			$awards = 'NULL';
		}else{
			$awards = "'".$_POST['awards']."'";
		}
		$conn = mysqli_connect("localhost","root","","staff_info");
		if (mysqli_connect_error()){
			echo "can't connect to database";
		}
		else{
			$submit_query = "INSERT INTO `staff` (`ssn`, `S_name`, `S_post`, `S_info`, `date_of_birth`, `date_of_joining_institute`, `qualification_with_class/grade`, `total_experience_in_years`, `papers_published`, `books_published`, `professional_memberships`, `awards`, `S_email`, `dept`, `photo`) VALUES ('','$sname','$designation','$info','$dob','$doji','$qualification','$experiance',$papers,$books,$memberships,$awards,'$email','$department','$image');";
			
			if(mysqli_query($conn, $submit_query)){
				$status2 = "success";
			} else {
				$status2 = "fail";
			}
		}
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Staff Activity </title>
<link rel="stylesheet" href="css/datastyle.css">
<script src="js/jquery-3.5.1.min.js"></script>
</head>


<body>
	<header style="background-color: turquoise;height: 100px"></header>
	<div id="main">
	<div id="data_add_button">
		<div id="select_buttons">
		<!--<div onclick="location.href='#exist';" class="add_button active"><span class="text">Add program in existing staff </span></div>
		<div onclick="location.href='#new';" class="add_button"><span class="text">Add program of new staff</span></div>-->
		<div onclick="scrollWin(-20000, 0)" class="add_button active"><span class="text">Add program in existing staff </span></div>
		<div onclick="scrollWin(20000, 0)" class="add_button"><span class="text">Add program of new staff</span></div>
		</div>
	</div>
	<div id="data_in">
		<div id="exist" class="form">
			<form id="existf" method="post">
				<fieldset>
					<legend>Select staff:</legend>
					<div class="container">
					<div>
						<label for="select_dept">Select Department:<sup class="red">*</sup></label><br>
						<select id="select_dept" name="sdept" required >
							<option value="">--Select Department--</option>
							<option class="do" id="Mechanical" value="mechanical">Mechanical Department</option>
							<option class="do" id="Electronics And Telecommunications" value="Electronics And Telecommunications">EXTC Department</option>
							<option class="do" id="Instrumentation" value="Instrumentation">Instrumentation Department</option>
							<option class="do" id="Computer" value="Computer">Computer Department</option>
							<option class="do" id="IT" value="IT">IT Department</option>
							<option class="do" id="Civil" value="Civil">Civil Department</option>
						</select> 
					</div>
					<div>
						<label for="select_staff">Select Staff:<sup class="red">*</sup></label><br>
						<select id="select_staff" name="sstaff" required >
						<option value=''>--Select Staff--</option>
						</select> 
					</div>
					</div>
					<div id="infoo"> 
						
					</div>
				</fieldset>
				<fieldset>
					<legend>Add program info:</legend>
					<div class="container">
						<div id="select_type">
							<label for="select_type">Program type:<sup class="red">*</sup></label><br>
							<input class="type" type="radio" id="FDP" style="margin-left: 0;" name="type" value="FDP" required >
							<label class="type" for="FDP">FDP</label>
							<input class="type" type="radio" id="STTP" name="type" value="STTP" required>
							<label class="type" for="STTP">STTP</label>
							<input class="type" type="radio" id="Workshop" name="type" value="Wrokshop" required >
							<label class="type" for="Workshop">Workshop</label>
						</div>
						<div id="select_tol">
							<div>
							<label for="tol">Title of linkage:<sup class="red">*</sup></label><br>
							<input type="text" id="tol" name="tol" placeholder="Title of linkage" required >
							</div>
							<div>
							<label for="pi">Participating Institute:<sup class="red">*</sup></label><br>
							<input type="text" id="pi" name="pi" placeholder="Participating institute" required >
							</div>
						</div>
						<div id="select_duration">
							<div>
							<label for="sd">Start date:<sup class="red">*</sup></label><br>
							<input type="date" id="sd" name="sd" required>
							</div>
							<div>
							<label for="ed">End date:<sup class="red">*</sup></label><br>
							<input type="date" id="ed" name="ed" required >
							</div>
						</div>
						<div id="select_nol">
							<div>
							<label for="year">Year:<sup class="red">*</sup></label><br>
							<select id="year" name="year" required ></select>
							</div>
							<div>
							<label for="nol">Nature of linkage:<sup class="red">*</sup></label><br>
							<input type="text" id="nol" name="nol" placeholder="Nature of linkage" required>
							</div>
						</div>
				</fieldset>
				<div id="submit">
				<input type="submit" id="upload" name="upload1" value="Upload" form="existf">
				<p id="status">
					<?php
						if($status1 == "success"){
							echo "<script>alert('New record created successfully')</script>";
						} else if($status1 == "fail") {
							echo "<script>alert('Error while uploading data')</script>";
						}
					?>
				</p>
				</div>
			</form> 
		</div>
		<div id="new" class="form">
		<form id="newf" method="post" enctype="multipart/form-data">
			<div class="container">
				<div>
					<label for="sname">Staff Name:<sup class="red">*</sup></label><br>
					<input type="text" id="sname" name="sname" placeholder="Staff Name" required/><br>

					<label for="designation">Staff Designation:<sup class="red">*</sup></label><br>
					<input type="text" id="designation" name="designation" placeholder="Staff Post" required/><br>

					<label for="department">Department:<sup class="red">*</sup></label><br>
					<select id="department" name="department" required ><br>
						<option value="">--Select Department--</option>
						<option id="Mechanical" value="Mechanical">Mechanical Department</option>
						<option id="Electronics And Telecommunications" value="Electronics And Telecommunications">EXTC Department</option>
						<option id="Instrumentation" value="Instrumentation">Instrumentation Department</option>
						<option id="Computer" value="Computer">Computer Department</option>
						<option id="IT" value="IT">IT Department</option>
						<option id="Civil" value="Civil">Civil Department</option>
					</select> 
				</div>
				<div id="staffpic" style="padding: 0 20px;">
					<div id="dash">
					<img src="images/addimg.png" id="preview" width="100%" height="100%"/>
					</div>
					<input type="file" id="image" name="image" accept="image/*" required>
					
				</div>
				<div>
					<label for="dob">Date of Birth:<sup class="red">*</sup></label><br>
					<input type="date" id="dob" name="dob" required><br>

					<label for="doji">Date of Joining the Institute:<sup class="red">*</sup></label><br>
					<input type="date" id="doji" name="doji" required><br>

					<label for="experiance">Total experiance In Years:<sup class="red">*</sup></label><br>
					<input type="text" id="experiance" name="experiance" pattern="[0-9]+" placeholder="eg: 7" required><br>

					<label for="qualification">Qualification with class/grade:<sup class="red">*</sup></label><br>
					<input type="text" id="qualification" name="qualification" placeholder="Staff Qualification" required><br>

					<label for="papers">Total Papers Published:</label><br>
					<input type="text" id="papers" name="papers" pattern="[0-9]+" placeholder="In numbers(left blank if none)"><br>

					<label for="books">Total Books Published:</label><br>
					<input type="text" id="books" name="books" pattern="[0-9]+" placeholder="In numbers(left blank if none)"><br>
				</div>
				<div>
					<label for="email">Email:<sup class="red">*</sup></label><br>
					<input type="Email" id="email" name="email" required placeholder="example@vcet.edu.in "><br>

					<label for="info">Staff Information:<sup class="red">*</sup></label><br>
					<textarea id="info" name="info" required placeholder="Some Info about staff"></textarea><br>

					<label for="memberships">Professional memberships:</label><br>
					<textarea id="memberships" name="memberships" placeholder="Memberships(left blank if none)"></textarea><br>

					<label for="awards">Awards:</label><br>
					<textarea id="awards" name="awards" placeholder="Awards(left blank if none)"></textarea><br>
				</div>

				<div id="submit">
					<input type="submit" id="upload" name="upload2" value="Upload" form="newf" onclick="checkvalid()">
					<p id="status">
						<?php
							if($status2 == "success"){
								echo "<script>alert('New record created successfully')</script>";
							} else if($status2 == "fail") {
								echo "<script>alert('Error while uploading data')</script>";
							}
						?>
					</p>
				</div>
			</div>
		</form>
		</div>
	</div>
	</div>
</body>
<script src="js/datalogic.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>