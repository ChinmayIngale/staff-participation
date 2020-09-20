<?php
if(isset($_POST["dname"])){
    $conn = mysqli_connect("localhost","root","","staff_info");
    if (mysqli_connect_error()){
        echo "can't connect to database";
    }
    else{
        $dname = $_POST["dname"];
        if($dname === "all"){
            $names_query = "SELECT * FROM `staff` ORDER BY `S_post` DESC";
        }
        else{
            $names_query = "SELECT * FROM `staff` WHERE dept='$dname'";
        }
        $result = mysqli_query($conn, $names_query);
        echo "<option value=''>--Select Staff--</option>";
        while($row = $result->fetch_array()){
            echo "<option title= '".$row['dept']."' value='".$row['ssn']."'>".$row['S_name']."</option>";
        }
        
    }
}
   
if(isset($_POST["ssn"])){
    $conn = mysqli_connect("localhost","root","","staff_info");
    if (mysqli_connect_error()){
        echo "can't connect to database";
    }
    else{
        $ssn = $_POST["ssn"];
        $names_query = "SELECT * FROM `staff` WHERE `ssn`=$ssn";
        $result = mysqli_query($conn, $names_query);
        while($row = $result->fetch_array()){
            echo '<div id="info_parent">';
			echo '<div id="staffinfo">';
			echo '<div id="staffname">';
			echo '<h3>'.$row["S_name"].'</h3>';
			echo '</div>';
			echo '<div id="staffdes">'.$row["S_info"].'</div>';
			echo '</div>';
			echo '<div id="staffpic">';
			echo '<div>';
			echo '<img src="showimg.php?ssn='.$row["ssn"].'" width="200" height="200">';
			echo '</div>';
			echo '</div>';
			echo '</div>';
        }
        
    }
}

?>