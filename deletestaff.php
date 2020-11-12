<?php
	session_start();
	require_once('pdo.php');
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	if ( !isset($_SESSION['uname'])){
            die('ACCESS DENIED');
        
    }else{
        $delete_query = "DELETE FROM `staff` WHERE `ssn`= :ssn";
        $stmt = $pdo->prepare($delete_query);
        $status = $stmt->execute(array(
                ':ssn' => $_SESSION['ssn'])
            );
        session_destroy();
        header("Location: login_page.php");
        return;
        
    }
?>