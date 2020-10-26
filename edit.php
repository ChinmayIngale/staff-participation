<?php
	session_start();
	require_once('pdo.php');
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

    if ( !isset($_SESSION['uname']) || $_SESSION['user'] == 'admin'){
        die('ACCESS DENIED');
    
}
    
	$salt = 'XyZzy12*_';
	$status2="";
	if(isset($_POST['upload2'])){

		$sname = $_POST['sname'];
		$designation = $_POST['designation'];
		$department = $_POST['department'];
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

		if($_FILES['image']['tmp_name']){
			$image = addslashes(file_get_contents( $_FILES['image']['tmp_name']));
			$submit_query = "UPDATE `staff` SET `S_name` = :sname, `S_post` = :designation, `S_info` = :info, `date_of_birth` = :dob, `date_of_joining_institute` = :doji, `qualification_with_class/grade` = :qualification, `total_experience_in_years` = :experiance, `papers_published` = :papers, `books_published` = :books, `professional_memberships` = :memberships, `awards` = :awards, `S_email` = :email, `dept` = :department, `password` = :pass, `photo` = '$image' WHERE `ssn`= :ssn";

		}
		else{
			$submit_query = "UPDATE `staff` SET `S_name` = :sname, `S_post` = :designation, `S_info` = :info, `date_of_birth` = :dob, `date_of_joining_institute` = :doji, `qualification_with_class/grade` = :qualification, `total_experience_in_years` = :experiance, `papers_published` = :papers, `books_published` = :books, `professional_memberships` = :memberships, `awards` = :awards, `S_email` = :email, `dept` = :department, `password` = :pass WHERE `ssn`= :ssn";

		}
		
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
		$stmt->bindValue(':ssn',$_SESSION['ssn'], PDO::PARAM_INT);

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
    
    $query = "SELECT * FROM staff where `ssn`= :ssn";
    $stmt = $pdo->prepare($query);
    $status = $stmt->execute(array(
            ':ssn' => $_SESSION['ssn'])
        );
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row == false){
        die("Account doesn't exist");
    }
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Staff Profile </title>
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
		</nav>
	</header>
    
	<div id="main">
    <div id="data_in" style="margin: 50px auto; width: 60%">
    <div id="new" class="form">
		<form id="newf" method="post" enctype="multipart/form-data">
			<div class="container">
				<div>
					<label for="sname">Staff Name:<sup class="red">*</sup></label><br>
					<input type="text" id="sname" name="sname" placeholder="Staff Name" value="<?= ($row['S_name'] !== '')? htmlentities($row['S_name']) : ''; ?>" required/><br>

					<label for="email">Email:<sup class="red">*</sup></label><br>
					<input type="Email" id="email" name="email" required placeholder="example@vcet.edu.in" value="<?= ($row['S_email'] !== '')? htmlentities($row['S_email']) : ''; ?>"><br>

					<label for="pass">Password:<sup class="red">*</sup></label><br>
					<input type="password" id="pass" name="pass" required placeholder="Enter new password"><span class="eye"><i class="fa fa-eye" aria-hidden="true"></i></span><br>
				</div>
				<div id="staffpic" style="padding: 0 20px;">
					<div id="dash">
					<img src="<?= ($row['ssn'] !== '')? 'showimg.php?ssn='.$row['ssn'] : 'images/addimg.png'; ?>" id="preview" width="100%" height="100%"/>
					</div>
					<input type="file" id="image" name="image" accept="image/*">
					
				</div>
				<div>
					<label for="department">Department:<sup class="red">*</sup></label><br>
					<select id="department" name="department" required >
						<option value="" >--Select Department--</option>
						<option value="Mechanical" <?=( $row['dept'] == "Mechanical") ? 'selected' : ''; ?>>Mechanical Department</option>
						<option value="Electronics And Telecommunications" <?=( $row['dept'] == "Electronics And Telecommunications") ? 'selected' : ''; ?>>Electronics And Telecommunications Department</option>
						<option value="Instrumentation" <?=( $row['dept'] == "Instrumentation") ? 'selected' : ''; ?>>Instrumentation Department</option>
						<option value="Computer" <?=( $row['dept'] == "Computer") ? 'selected' : ''; ?>>Computer Department</option>
						<option value="Information Technology" <?=( $row['dept'] == "Information Technology") ? 'selected' : ''; ?>>Information Technology Department</option>
						<option value="Civil" <?=( $row['dept'] == "Civil") ? 'selected' : ''; ?>>Civil Department</option>
					</select> <br>

					<label for="designation">Staff Designation:<sup class="red">*</sup></label><br>
					<input type="text" id="designation" name="designation" placeholder="Staff Post" value="<?= ($row['S_post'] !== '')? htmlentities($row['S_post']) : ''; ?>" required/><br>

					<label for="dob">Date of Birth:<sup class="red">*</sup></label><br>
					<input type="date" id="dob" name="dob" value="<?= ($row['date_of_birth'] !== '')? htmlentities($row['date_of_birth']) : ''; ?>" required><br>

					<label for="doji">Date of Joining the Institute:<sup class="red">*</sup></label><br>
					<input type="date" id="doji" name="doji" value="<?= ($row['date_of_joining_institute'] !== '')? htmlentities($row['date_of_joining_institute']) : ''; ?>" required><br>

					<label for="experiance">Total experiance In Years:<sup class="red">*</sup></label><br>
					<input type="text" id="experiance" name="experiance" pattern="[0-9]+" placeholder="eg: 7" value="<?= ($row['total_experience_in_years'] !== '')? htmlentities($row['total_experience_in_years']) : ''; ?>" required><br>

					<label for="papers">Total Papers Published:</label><br>
					<input type="text" id="papers" name="papers" pattern="[0-9]+" value="<?= ($row['papers_published'] !== '')? htmlentities($row['papers_published']) : ''; ?>" placeholder="In numbers(left blank if none)"><br>

					<label for="books">Total Books Published:</label><br>
					<input type="text" id="books" name="books" pattern="[0-9]+" value="<?= ($row['books_published'] !== '')? htmlentities($row['books_published']) : ''; ?>" placeholder="In numbers(left blank if none)"><br>
				</div>
				<div>
					<label for="qualification">Qualification with class/grade:<sup class="red">*</sup></label><br>
					<input type="text" id="qualification" name="qualification" placeholder="Staff Qualification" value="<?= ($row['qualification_with_class/grade'] !== '')? htmlentities($row['qualification_with_class/grade']) : ''; ?>" required><br>

					<label for="info">Staff Information:<sup class="red">*</sup></label><br>
					<textarea id="info" name="info" required placeholder="Some Info about staff" ><?= ($row['S_info'] !== '')? htmlentities($row['S_info']) : ''; ?></textarea><br>

					<label for="memberships">Professional memberships:</label><br>
					<textarea id="memberships" name="memberships" placeholder="Memberships(left blank if none)"><?= ($row['professional_memberships'] !== '')? htmlentities($row['professional_memberships']) : ''; ?></textarea><br>

					<label for="awards">Awards:</label><br>
					<textarea id="awards" name="awards" placeholder="Awards(left blank if none)"><?= ($row['awards'] !== '')? htmlentities($row['awards']) : ''; ?></textarea><br>
				</div>

				<div id="submit">
					<input type="submit" class="upload" name="upload2" value="Update" form="newf" >
					<a href="staffdata.php"><input type="button" value="cancel" class="upload"></a>
                    
					<?php
						if($status2 == "success"){
							echo "<script>alert('Profile Updated".$n."');
								location.href='staffdata.php';
								</script>";
							
						} else if($status2 == "fail") {
							echo "<script>alert('Error while updating profile');
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