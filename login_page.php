<?php
  session_start();
  require_once('pdo.php');

  if(isset($_SESSION['uname'])){
    if($_SESSION['user'] == 'admin'){
      header("Location: add_program.php");
      return;
    }
    if($_SESSION['user'] == 'staff'){
      header("Location: staffdata.php");
      return;
    }
  }
  
  if ( isset($_POST['uname']) && isset($_POST['pass']) ) {
    $salt = 'XyZzy12*_';
    $stored_hash = '3167f748abd7e549c164479796a1d510';
      
    $check = hash('md5', $salt.$_POST['pass']);
    echo $check;
      if ( $_POST['uname'] === "admin@vcet.edu.in" && $stored_hash == $check) {
          $_SESSION['uname'] = $_POST['uname'];
          $_SESSION['user'] = 'admin';
          header("Location: add_program.php");
          return;
      }
      $validation_query = "SELECT * FROM staff where `S_email`= :email";
      $stmt = $pdo->prepare($validation_query);
      $status = $stmt->execute(array(
          ':email' => $_POST['uname'])
        );
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row == false){
        $_SESSION['error'] = 'There is no account associated with this email';
        header("Location: login_page.php");
        return;
      }
      else{
        if($row['password'] == $check){
          $_SESSION['uname'] = $row['S_name'];
          $_SESSION['ssn'] = $row['ssn'];
          $_SESSION['user'] = 'staff';
          header("Location: staffdata.php");
          return;
        }else{
          $_SESSION['error'] = "Incorrect Password";
          header("Location: login_page.php");
          return;
        }
      }
      
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup/login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>
<body>
<header>
  <nav id="header">
      <div class="header_logo">
        <a href="https://www.vcet.edu.in/">
          <div id="logo-img"></div>
        </a>
      </div>
        <div class="header_name">
          <a href="https://www.vcet.edu.in/"><h1>Vidyavardhini's College Of Engineering & Technology</h1>
          <p>विद्यावर्धिनीचे अभियांत्रिकी आणि तंत्रज्ञान महाविद्यालय, वसई</p></a>
        </div>
  </nav>

</header>
<div class="form">
      
    <h2>Staff Login</h2>
    
    <form id="loginform" method="post">
    <?php
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
      <div class="field-wrap">
      <label>
        Username<span class="req">*</span>
      </label>
      <input type="Email" name="uname" id="username" required autocomplete="on"/>
    </div>
    
    <div class="field-wrap">
      <label>
        Password<span class="req">*</span>
      </label>
      <input type="password" name="pass" id="pass" required autocomplete="off"/>
      <span class="eye"><i class="fa fa-eye" aria-hidden="true" style="font-size: 1.2em;"></i> show password</span>
      
    </div>
    
    <div id="submit">
    <input type="submit" id="loginbtn" class="button " value="Log In"></button>
    <p class="signup">OR <a href="signup.php">SIGN UP</a></p>
    </div>
    </form>
   
</div>
<script src="js/login_page.js"></script>
</body>
</html>