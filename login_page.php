<?php
  session_start();
  if ( isset($_POST['uname']) && isset($_POST['pass']) ) {
    $salt = 'XyZzy12*_';
    $stored_hash = '3167f748abd7e549c164479796a1d510';
      
    $check = hash('md5', $salt.$_POST['pass']);
    echo $check;
      if ( $_POST['uname'] == "admin" && $stored_hash == $check) {
          $_SESSION['uname'] = $_POST['uname'];
          header("Location: add_program.php");
          return;
      } else {
          $_SESSION['error'] = "Incorrect Username or Password";
          header("Location: login_page.php");
          return;
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup/login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.5.0/js/md5.min.js"></script>
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
      
    <h2>Admin Login</h2>
    
    <form id="loginform" method="post">
    <?php
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
?>
      <div class="field-wrap">
      <label>
        Username/E-mail<span class="req">*</span>
      </label>
      <input type="text" name="uname" id="username" required autocomplete="off"/>
    </div>
    
    <div class="field-wrap">
      <label>
        Password<span class="req">*</span>
      </label>
      <input type="password" name="pass" id="pass" required autocomplete="off"/>
      
    </div>
    
    <p class="forgot"><a href="#">Forgot Password?</a></p>
    
    <input type="submit" id="loginbtn" class="button " value="Log In"></button>
    
    </form>
   
</div> <!-- /form -->
<script src="js/login_page.js"></script>
</body>
</html>