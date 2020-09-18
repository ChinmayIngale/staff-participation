<?php
	$status="";
	if(isset($_POST['upload'])){
		echo "done";
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
				$status = "success";
			} else {
				$status = "fail";
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
						<label for="select_dept">Select department:</label><br>
						<select id="select_dept" name="sdept" required >
							<option value="">--Select Department--</option>
							<option class="do" id="Mechanical" value="mechanical">Mechanical Department</option>
							<option class="do" id="Electronics And Telecommunications" value="Electronics And Telecommunications">EXTC Department</option>
							<option class="do" id="Instrumentation" value="instrumentation">Instrumentation Department</option>
							<option class="do" id="Computer" value="computer">Computer Department</option>
							<option class="do" id="IT" value="it">IT Department</option>
							<option class="do" id="Civil" value="civil">Civil Department</option>
						</select> 
					</div>
					<div>
						<label for="select_staff">Select staff:</label><br>
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
							<label for="select_type">Program type:</label><br>
							<input class="type" type="radio" id="FDP" style="margin-left: 0;" name="type" value="FDP" required >
							<label class="type" for="FDP">FDP</label>
							<input class="type" type="radio" id="STTP" name="type" value="STTP" required>
							<label class="type" for="STTP">STTP</label>
							<input class="type" type="radio" id="Workshop" name="type" value="Wrokshop" required >
							<label class="type" for="Workshop">Wrokshop</label>
						</div>
						<div id="select_tol">
							<div>
							<label for="tol">Title of linkage:</label><br>
							<input type="text" id="tol" name="tol" required >
							</div>
							<div>
							<label for="pi">Participating institute:</label><br>
							<input type="text" id="pi" name="pi" required >
							</div>
						</div>
						<div id="select_duration">
							<div>
							<label for="year">Year:</label>
							<select id="year" name="year" required ></select>
							</div>
							<div>
							<label for="sd">Start date:</label>
							<input type="date" id="sd" name="sd" required>
							</div>
							<div>
							<label for="ed">End date:</label>
							<input type="date" id="ed" name="ed" required >
							</div>
						</div>
						<div id="select_nol">
							<label for="nol">Nature of linkage:</label>
							<input type="text" id="nol" name="nol" required>
						</div>
				</fieldset>
				<div id="submit">
				<input type="submit" id="upload" name="upload" value="Upload" form="existf">
				<p id="status" class="<?php  echo ($status == "success")?"green":"red"; ?>">
					<?php
						if($status == "success"){
							echo "New record created successfully";
						} else if($status == "fail") {
							echo "Error while uploading data";
						}
					?>
				</p>
				</div>
			</form> 
		</div>
		<div id="new" class="form">
		<form id="newf">
			<div class="container">
				<div>
					<label for="sname">Staff Name:</label><br>
					<input type="text" id="sname" name="sname" required/><br>

					<label for="designation">Staff Designation:</label><br>
					<input type="text" id="designation" name="designation" required/><br>

					<label for="department">Department:</label><br>
					<select id="department" name="department" required ><br>
						<option value="">--Select Department--</option>
						<option id="Mechanical" value="mechanical">Mechanical Department</option>
						<option id="Electronics And Telecommunications" value="Electronics And Telecommunications">EXTC Department</option>
						<option id="Instrumentation" value="instrumentation">Instrumentation Department</option>
						<option id="Computer" value="computer">Computer Department</option>
						<option id="IT" value="it">IT Department</option>
						<option id="Civil" value="civil">Civil Department</option>
					</select> 
				</div>
				<div id="staffpic" style="text-align: center;padding: 20px 20px;">
					<div id="dash">
					<img src="images/addimg.png" id="preview" width="100%" height="100%"/>
					<input type="file" id="image" name="image" accept="image/*">
					</div>
				</div>
				<div>
					<label for="dob">Date of Birth:</label><br>
					<input type="date" id="dob" name="dob" required><br>

					<label for="doji">Date of Joining the Institute:</label><br>
					<input type="date" id="doji" name="doji" required><br>

					<label for="experiance">Total experiance In Years:</label><br>
					<input type="text" id="experiance" name="experiance" required><br>

					<label for="qualification">Qualification with class/grade:</label><br>
					<input type="text" id="qualification" name="qualification" required><br>

					<label for="papers">Total Papers Published:</label><br>
					<input type="text" id="papers" name="papers"><br>

					<label for="books">Total Books Published</label><br>
					<input type="text" id="books" name="books"><br>
				</div>
				<div>
					<label for="email">Email:</label><br>
					<input type="Email" id="email" name="email" required><br>

					<label for="info">Staff Information:</label><br>
					<textarea id="info" name="info" required></textarea><br>

					<label for="memberships">Professional memberships:</label><br>
					<textarea id="memberships" name="memberships"></textarea><br>

					<label for="awards">Awards:</label><br>
					<textarea id="awards" name="awards"></textarea><br>
				</div>

				<div id="submit">
					<input type="submit" id="upload" name="upload" value="Upload" form="newf">
					<p id="status"></p>
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
