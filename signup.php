<?php
	session_start();
	require_once('pdo.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    
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
			header("Location: signup.php");
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

		$ssn = $pdo->lastInsertId();
		$_SESSION['ssn']= $ssn ;
		$_SESSION['user']= 'staff';
		$_SESSION['uname']= $sname;

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
<title>New Account </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/signup.css">
<script src="js/jquery-3.5.1.min.js"></script>
</head>


<body>
<header>
  <nav id="header">
      <div class="header_logo">
        <a href="index.php">
          <div id="logo-img"></div>
        </a>
      </div>
        <div class="header_name">
          <a href="index.php"><h1>Vidyavardhini's College Of Engineering & Technology</h1>
          <p>विद्यावर्धिनीचे अभियांत्रिकी आणि तंत्रज्ञान महाविद्यालय, वसई</p></a>
        </div>
  </nav>

</header>
    
	<div id="main">
    <div id="data_in" style="margin: 50px auto;">
    <div id="new" class="form">
		<form id="newf" method="post" enctype="multipart/form-data">
			<div class="container">
				<div>
					<label for="sname">Staff Name:<sup class="red">*</sup></label><br>
					<input type="text" id="sname" name="sname" placeholder="Staff Name" required/><br>

					<label for="email">Email:<sup class="red">*</sup></label><br>
					<input type="Email" id="email" name="email" required placeholder="example@vcet.edu.in "><br>
					<?php
					if ( isset($_SESSION['error']) ) {
						echo('<p class="red">'.htmlentities($_SESSION['error'])."</p><br>");
						unset($_SESSION['error']);
					}
					?>

					<label for="pass">Password:<sup class="red">*</sup></label><br>
					<input type="password" id="pass" name="pass" required placeholder="Password "><span class="eye"><i class="fa fa-eye" aria-hidden="true"></i></span><br>
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
					<input type="submit" class="upload" name="upload2" value="Create Account" form="newf" >
					<p class="login">OR <a href="login_page.php">LOGIN</a></p>

					<?php
						if($status2 == "success"){
							echo "<script>alert('Account Created');
								location.href='staffdata.php';
								</script>";
							
						} else if($status2 == "fail") {
							echo "<script>alert('Error while creating account');
							location.href='signup.php';
							</script>";
						}
					?>
					
				</div>
			</div>
		</form>
		</div>
    
    </div>
	</div>
</body>
<script>
document.addEventListener("DOMContentLoaded", () => {
	var date = new Date();
	var start = date.getFullYear();
	var date = new Date();
	var dd = date.getDate();
	var mm = date.getMonth()+1;

	//January is 0
	var yyyy = date.getFullYear();
	var today = yyyy+'-'+mm+'-'+dd;

	document.getElementById("dob").setAttribute("max", today);
	document.getElementById("doji").setAttribute("max", today);

	const img = document.querySelector("#preview");
	const select = document.querySelector("#image");
	img.addEventListener('click', function() {
		select.click();
	});
	select.addEventListener("change",function(event){
		var reader = new FileReader();
		reader.onload = function(){
			if(reader.readyState == 2){
				img.src = reader.result;
			}
		}
		reader.readAsDataURL(event.target.files[0]);

	});

	//show password

	document.querySelector('.eye').addEventListener('click',function () {
		var x = document.getElementById("pass");
		if (x.type === "password") {
			x.type = "text";
			document.querySelector('.eye').innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
		} else {
			x.type = "password";
			document.querySelector('.eye').innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
		}
	});
});

if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}
</script>
</html>