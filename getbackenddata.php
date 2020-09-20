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
            $name = $row['S_name'];
            $info = $row['S_info'];
            $ssn = $row['ssn'];
            $dept = $row['dept'];
            echo '<div id="bio">';
            echo '<div id="info_parent">';
			echo '<div id="staffinfo">';
			echo '<div id="staffname">';
			echo '<h3>'.$name.'</h3>';
			echo '</div>';
			echo '<div id="staffdes">'.$info.'</div>';
			echo '</div>';
			echo '<div id="staffpic">';
			echo '<div>';
			echo '<img src="showimg.php?ssn='.$ssn.'" width="200" height="200">';
			echo '</div>';
			echo '</div>';
            echo '</div>';
            echo '</div>';
            
            echo '<div id="table">';
            echo '<table class="info">
                        <thead>
                        <tr class="data_tr">
                            <th class="data_th" rowspan="2">SR. No</th>
                            <th class="data_th" rowspan="2">Type</th>
                            <th class="data_th" rowspan="2">Title of the linkage</th>
                            <th class="data_th" rowspan="2">name of participation institution</th>
                            <th class="data_th" rowspan="2">Year of commenceme</th>
                            <th class="data_th" colspan="2">Duration</th>
                            <th class="data_th" rowspan="2">Nature of linkage</th>
                            <th class="data_th" rowspan="2">Operation</th>
                        </tr>
                        <tr class="data_tr">
                            <th class="data_th">start date</th>
                            <th class="data_th">end date</th>
                        </tr>
                        </thead>
                    <tbody>';
            $sr = 1;
            $table_query = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$dept` WHERE ssn=$ssn ORDER BY TYPE, start_date;";
            $table = mysqli_query($conn, $table_query);
            while($row = $table->fetch_array()){
                $tsr= $row['sr.'];
                $ssn = $row['ssn'];
                $type = $row['TYPE'];
                $tol = $row['title_of_linkage'];
                $pi = $row['participating_institute'];
                $year = $row['year'];
                $sd = $row['sd'];
                $ed = $row['ed'];
                $nol = $row['nature_of_linkage'];

                echo '<tr class="data_tr">';
                echo '<td class="data_td">'.$sr.'</td>';
                echo '<td class="data_td">'.$type.'</td>';
                echo '<td class="data_td">'.$tol.'</td>';
                echo '<td class="data_td">'.$pi.'</td>';
                echo '<td class="data_td">'.$year.'</td>';    
                echo '<td class="data_td">'.$sd.'</td>';
                echo '<td class="data_td">'.$ed.'</td>';
                echo '<td class="data_td">'.$nol.'</td>';
                echo '<td class="data_td"><button onClick="deleteInfo('.'`'.$dept.'`'.','.$tsr.')">Delete</button></td>';
                echo '</tr>';
                $sr++; 
            }
            echo '</tbody>
            </table>';
            echo '</div>';
        }
        
    }
}

?> 