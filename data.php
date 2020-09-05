<?php
$guess=$_GET['ssn']??003;
$sql = "SELECT * FROM staff WHERE ssn=$guess;";
echo $sql;
$conn = mysqli_connect("localhost","root","","staff_info");
if (mysqli_connect_error()){
    echo "can't connect to database";
}
else{
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_array()){
        $ssn = $row['ssn'];
        $sname = $row['S_name'];
        $sinfo = $row['S_info'];
        $dept = $row['dept'];
    }
    $sql2 = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$dept` WHERE ssn=$ssn;";
    echo $sql2;
    $table = mysqli_query($conn, $sql2);
}
?>

<style>


#teachers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#teachers td, #teachers th {
  border: 1px solid #ddd;
  padding: 10px;
}

#teachers tr:nth-child(even){background-color: #f2f2f2;}

#teachers tr:hover {background-color: #ddd;}

#teachers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: grey;
  color: white;
}
</style>

<table id="teachers">
<tr>
    <th rowspan="2">SR. No</th>
    <th rowspan="2">Title of the linkage</th>
    <th rowspan="2">name of participation institution</th>
    <th rowspan="2">Year of commenceme</th>
    <th colspan="2">Duration</th>
    <th rowspan="2">Nature of linkage</th>

  </tr>
  <tr>
    <th>start date</th>
    <th>end date</th>
  </tr>


  
<?php
$sr = 1;
  while($row = $table->fetch_array()){
    
    $ssn = $row['ssn'];
    $type = $row['TYPE'];
    $tol = $row['title_of_linkage'];
    $pi = $row['participating_institute'];
    $year = $row['year'];
    $sd = $row['sd'];
    $ed = $row['ed'];
    $nol = $row['nature_of_linkage'];

    echo '<tr>';
    echo '<td>'.$sr.'</td>';
    echo '<td>'.$tol.'</td>';
    echo '<td>'.$pi.'</td>';
    echo '<td>'.$year.'</td>';    
    echo '<td>'.$sd.'</td>';
    echo '<td>'.$ed.'</td>';
    echo '<td>'.$nol.'</td>';
    echo '</tr>';
    $sr++; 
}
?>
</table>

