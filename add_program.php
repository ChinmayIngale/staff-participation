<?php
	session_start();
	require_once('pdo.php');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	if ( !isset($_SESSION['uname']) || $_SESSION['user'] == 'staff'){
		die('ACCESS DENIED');
	
}
	
	$salt = 'XyZzy12*_';
	$status2="";
	if(isset($_POST['upload2'])){
		$validation_query = "SELECT * FROM staff where `S_email`= :email";
		$stmt = $pdo->prepare($validation_query);
		$status = $stmt->execute(array(
				':email' => $_POST['email'])
			);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row != false){
			$_SESSION['error'] = 'There is already an account associated with this email';
			header("Location: add_program.php");
            return;
		}

		$sname = $_POST['sname'];
		$designation = $_POST['designation'];
		$department = $_POST['department'];
		$image = addslashes(file_get_contents( $_FILES['image']['tmp_name']));
		$dob = $_POST['dob'];
		$doji = $_POST['doji'];
		$experiance = $_POST['experiance'];
		$qualification = $_POST['qualification'];
		$pass = hash('md5', $salt.$_POST['pass']);
		
		if(trim($_POST['papers']) == ""){
			$papers = NULL;
		}else{
			$papers = $_POST['papers'];
		}
		if(trim($_POST['books']) == ""){
			$books = NULL;
		}else{
			$books = $_POST['books'];
		}
		$email = $_POST['email'];
		$info = $_POST['info'];
		if(trim($_POST['memberships']) == ""){
			$memberships = NULL;
		}else{
			$memberships = $_POST['memberships'];
		}
		if(trim($_POST['awards']) == ""){
			$awards = NULL;
		}else{
			$awards = $_POST['awards'];
		}

		
		$submit_query = "INSERT INTO `staff` (`ssn`, `S_name`, `S_post`, `S_info`, `date_of_birth`, `date_of_joining_institute`, `qualification_with_class/grade`, `total_experience_in_years`, `papers_published`, `books_published`, `professional_memberships`, `awards`, `S_email`, `dept`, `password`, `photo`) VALUES 
		('', :sname, :designation, :info, :dob, :doji, :qualification, :experiance, :papers, :books, :memberships, :awards, :email, :department, :pass, '$image');";
		$stmt = $pdo->prepare($submit_query);
		$stmt->bindValue(':sname',$sname, PDO::PARAM_STR);
		$stmt->bindValue(':designation',$designation, PDO::PARAM_STR);
		$stmt->bindValue(':info',$info, PDO::PARAM_STR);
		$stmt->bindValue(':dob',$dob, PDO::PARAM_STR);
		$stmt->bindValue(':doji',$doji, PDO::PARAM_STR);
		$stmt->bindValue(':qualification',$qualification, PDO::PARAM_STR);
		$stmt->bindValue(':experiance',$experiance, PDO::PARAM_INT);
		$stmt->bindValue(':papers',$papers, PDO::PARAM_INT);
		$stmt->bindValue(':books',$books, PDO::PARAM_INT);

		$stmt->bindValue(':memberships',$memberships, PDO::PARAM_STR);
		$stmt->bindValue(':awards',$awards, PDO::PARAM_STR);
		$stmt->bindValue(':email',$email, PDO::PARAM_STR);
		$stmt->bindValue(':department',$department, PDO::PARAM_STR);
		$stmt->bindValue(':pass',$pass, PDO::PARAM_STR);
		$status = $stmt->execute();

			if($status){
				$status2 = "success";
			} else {
				$status2 = "fail";
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
</head>

<body>
	<header style="background-color: turquoise;">
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
				<a href="logout.php"><button id="index">Log out</button></a>
			</div>
		</nav>
	</header>
	<div id="main">
	<div id="data_add_button">
		<div id="select_buttons">
		<div data-form="#exist" class="add_button active"><span class="text">Add program in Existing Staff </span></div>
		<div data-form="#new" class="add_button"><span class="text">Add New Staff</span></div>
		</div>
	</div>
	<div id="data_in">
		<div id="exist" class="form">
			<form id="existf" method="post" action="addnew.php">
					<legend>Select staff:</legend>
					<div class="container">
					<div>
						<label for="select_dept">Select Department:<sup class="red">*</sup></label><br>
						<select id="select_dept" name="dept" required >
							<option value="">--Select Department--</option>
							<option class="do" id="Mechanical" value="Mechanical" <?=$_SESSION['dept'] == "Mechanical" ? ' selected="selected"' : ''?>>Mechanical Department</option>
							<option class="do" id="Electronics And Telecommunications" value="Electronics And Telecommunications" <?=$_SESSION['dept'] == "Electronics And Telecommunications" ? ' selected="selected"' : ''?>>Electronics And Telecommunications Department</option>
							<option class="do" id="Instrumentation" value="Instrumentation" <?=$_SESSION['dept'] == "Instrumentation" ? ' selected="selected"' : ''?>>Instrumentation Department</option>
							<option class="do" id="Computer" value="Computer" <?=$_SESSION['dept'] == "Computer" ? ' selected="selected"' : ''?>>Computer Department</option>
							<option class="do" id="Information Technology" value="Information Technology" <?=$_SESSION['dept'] == "Information Technology" ? ' selected="selected"' : ''?>>Information Technology Department</option>
							<option class="do" id="Civil" value="Civil" <?=$_SESSION['dept'] == "Civil" ? ' selected="selected"' : ''?>>Civil Department</option>
						</select> 
					</div>
					<div>
						<label for="select_staff">Select Staff:<sup class="red">*</sup></label><br>
						<select id="select_staff" name="sstaff" required >
						<?php
								$names_query = "SELECT * FROM `staff` ORDER BY `S_post` DESC";
								echo "<option value=''>--Select Staff--</option>";
								$stmt = $pdo->prepare($names_query);
								$stmt->execute();
								$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
								foreach( $rows as $row ) {
									echo "<option class= '".htmlentities($row['dept'])."' value='".htmlentities($row['ssn'])."'";
									echo ($_SESSION['ssn'] == $row['ssn']) ? "selected='selected'" : "";
									echo ">".htmlentities($row['S_name'])."</option>";
								}
														
						?>
						</select>
						<input type="hidden" id="tsr" name="tsr">
					</div>
					</div>
					</form> 
					<div id="information">
					
					</div>
					<div id="try"></div>
			
		</div>
		<div id="new" class="form">
		<form id="newf" method="post" enctype="multipart/form-data">
			<div class="container">
				<div>
					<label for="sname">Staff Name:<sup class="red">*</sup></label><br>
					<input type="text" id="sname" name="sname" placeholder="Staff Name" required autocomplete="off"/><br>

					<label for="email">Email:<sup class="red">*</sup></label><br>
					<input type="Email" id="email" name="email" required placeholder="example@vcet.edu.in" autocomplete="off"><br>

					<label for="pass">Password:<sup class="red">*</sup></label><br>
					<input type="password" id="pass" name="pass" required placeholder="Password " autocomplete="off"><span class="eye"><i class="fa fa-eye" aria-hidden="true"></i></span><br>
				</div>
				<div id="staffpic" style="padding: 0 20px;">
					<div id="dash">
					<img src="images/addimg.png" id="preview" width="100%" height="100%"/>
					</div>
					<input type="file" id="image" name="image" accept="image/*" required>
					
				</div>
				<div>
					<label for="department">Department:<sup class="red">*</sup></label><br>
					<select id="department" name="department" required >	
						<option value="">--Select Department--</option>
						<option value="Mechanical">Mechanical Department</option>
						<option value="Electronics And Telecommunications">Electronics And Telecommunications Department</option>
						<option value="Instrumentation">Instrumentation Department</option>
						<option value="Computer">Computer Department</option>
						<option value="Information Technology">Information Technology Department</option>
						<option value="Civil">Civil Department</option>
					</select> <br>

					<label for="designation">Staff Designation:<sup class="red">*</sup></label><br>
					<input type="text" id="designation" name="designation" placeholder="Staff Post" required/><br>

					<label for="dob">Date of Birth:<sup class="red">*</sup></label><br>
					<input type="date" id="dob" name="dob" required><br>

					<label for="doji">Date of Joining the Institute:<sup class="red">*</sup></label><br>
					<input type="date" id="doji" name="doji" required><br>

					<label for="experiance">Total experiance In Years:<sup class="red">*</sup></label><br>
					<input type="text" id="experiance" name="experiance" pattern="[0-9]+" placeholder="eg: 7" required><br>

					<label for="papers">Total Papers Published:</label><br>
					<input type="text" id="papers" name="papers" pattern="[0-9]+" placeholder="In numbers(left blank if none)"><br>

					<label for="books">Total Books Published:</label><br>
					<input type="text" id="books" name="books" pattern="[0-9]+" placeholder="In numbers(left blank if none)"><br>
				</div>
				<div>
					<label for="qualification">Qualification with class/grade:<sup class="red">*</sup></label><br>
					<input type="text" id="qualification" name="qualification" placeholder="Staff Qualification" required><br>

					<label for="info">Staff Information:<sup class="red">*</sup></label><br>
					<textarea id="info" name="info" required placeholder="Some Info about staff"></textarea><br>

					<label for="memberships">Professional memberships:</label><br>
					<textarea id="memberships" name="memberships" placeholder="Memberships(left blank if none)"></textarea><br>

					<label for="awards">Awards:</label><br>
					<textarea id="awards" name="awards" placeholder="Awards(left blank if none)"></textarea><br>
				</div>

				<div id="submit">
					<input type="submit" class="upload" name="upload2" value="Upload" form="newf" >
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
	<?php
	if(isset($_SESSION['error'])){
		echo "alert('".$_SESSION['error']."');";
		unset($_SESSION['error']);
	}
	?>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
