<?php
session_start();
require_once('pdo.php');

if(isset($_POST["dname"])){
    
    $dname = $_POST["dname"];
    if($dname === "all"){
        $names_query = "SELECT * FROM `staff` ORDER BY `S_post` DESC";
    }
    else{
        $names_query = "SELECT * FROM `staff` WHERE dept= :dept";
    }

    echo "<option value=''>--Select Staff--</option>";
    $stmt = $pdo->prepare($names_query);
    $stmt->execute(array(
        ':dept' => $dname)
    );
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach( $rows as $row ) {
            echo "<option class= '".htmlentities($row['dept'])."' value='".htmlentities($row['ssn'])."'>".htmlentities($row['S_name'])."</option>";
        }  
}
   
if(isset($_POST["ssn"])){
    
    $ssn = $_POST["ssn"];
    $data_query = "SELECT * FROM `staff` WHERE `ssn`= :ssn";
    $stmt = $pdo->prepare($data_query);
    $stmt->execute(array(
            ':ssn' => $ssn)
        );
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $name = $row['S_name'];
    $info = $row['S_info'];
    $ssn = $row['ssn'];
    $dept = $row['dept'];
    $deptlower = strtolower($row['dept']);
    $_SESSION['name'] = $name; 
    $_SESSION['dept'] = $dept; 
    $_SESSION['ssn'] = $ssn; 
    echo '<div id="bio">';
    echo '<div id="info_parent">';
    echo '<div id="staffinfo">';
    echo '<div id="staffname">';
    echo '<h3>'.htmlentities($name).'</h3>';
    echo '</div>';
    echo '<div id="staffdes">'.$info.'</div>';
    if($_SESSION['user'] == 'staff'){
        echo '<a href="edit.php"><button id="editbtn">Edit Profile</button></a>';
    }
    echo '</div>';
    echo '<div id="staffpic">';
    echo '<div>';
    echo '<img src="showimg.php?ssn='.htmlentities($ssn).'" width="200" height="200">';
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
                    <th class="data_th" rowspan="2">Title</th>
                    <th class="data_th" rowspan="2">Organizing Agency</th>
                    <th class="data_th" rowspan="2">Year</th>
                    <th class="data_th" colspan="2">Duration</th>
                    <th class="data_th" rowspan="2">Name of Program</th>
                    <th class="data_th" rowspan="2">Operation</th>
                </tr>
                <tr class="data_tr">
                    <th class="data_th">start date</th>
                    <th class="data_th">end date</th>
                </tr>
                </thead>
            <tbody>';
    $sr = 1;
    $table_query = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$deptlower` WHERE ssn= :ssn ORDER BY TYPE, start_date;";
    $stmt = $pdo->prepare($table_query);
    $stmt->execute(array(
            ':ssn' => $ssn)
        );
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach( $rows as $row ) {
        $tsr= $row['sr.'];
        $ssn = $row['ssn'];
        $type = $row['TYPE'];
        $tol = $row['title_of_linkage'];
        $pi = $row['participating_institute'];
        $year = $row['year'];
        $sd = $row['sd'];
        $ed = $row['ed'];
        $nol = $row['nature_of_linkage'];

        echo '<tr class="data_tr">
                <td class="data_td">'.$sr.'</td>
                <td class="data_td">'.htmlentities($type).'</td>
                <td class="data_td">'.htmlentities($tol).'</td>
                <td class="data_td">'.htmlentities($pi).'</td>
                <td class="data_td">'.htmlentities($year).'</td>
                <td class="data_td">'.htmlentities($sd).'</td>
                <td class="data_td">'.htmlentities($ed).'</td>
                <td class="data_td">'.htmlentities($nol).'</td>
                <td class="data_td">
                <form class="deletef">
                    <button class="operation del" form="deletef" onClick="deleteInfo(`'.htmlentities($deptlower).'`,'.htmlentities($tsr).')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                </form>
                <button name="update" form="existf" class="operation update" onClick="modifyInfo(`'.htmlentities($deptlower).'`,'.htmlentities($tsr).')"><i class="fa fa-pencil" aria-hidden="true"></i> Modify</button>
                </td>
                </tr>';
        $sr++; 
    }
    echo '</tbody></table>';
    echo '</div>';
    echo '<div id="submit">';
    echo '<button id="newprg" name="newprg" form="existf" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add new program</button>';
    echo '</div>';
              
}
?> 
