

<style>
.info {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  display: none;
}
.info.show{
  display: table;
}
.info td, .info th {
  border: 1px solid #ddd;
  padding: 10px;
}

.info tr:nth-child(even){background-color: #f2f2f2;}

.info tr:hover {background-color: #ddd;}

.info th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: grey;
  color: white;
}
</style>

<div id="about" class="info show">About</div>

<table id="fdp" class="info">
  <thead>
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
  </thead>
<tbody>
  
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
</tbody>
</table>
<table id="sttp" class="info">
  <thead>
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
  </thead>
<tbody>
  
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
</tbody>
</table>
<table id="workshop" class="info">
  <thead>
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
  </thead>
<tbody>
  
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
</tbody>
</table>

