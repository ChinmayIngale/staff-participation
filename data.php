

<style>
.info {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: -40px;
  display: none;
}
.info.show{
  display: table;
  margin-top: 0;
}
.info .data_td, .info .data_th {
  border: 1px solid #ddd;
  padding: 10px;
}

.info .data_tr:nth-child(even){background-color: #f2f2f2;}

.info .data_tr:hover {background-color: #ddd;}

.info .data_th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: rgba(72, 174, 229, 0.7);
  color: white;
}
.about_tr{
  border-bottom: 1px solid black;
}
.about_th, .about_td{
  padding: 12px;
}
.about_th{
  width: 25%;
  text-transform: uppercase;
  text-align: left;
  font-weight: normal;
}
</style>
<div style="padding: 20px;">
<table id="about" class="info show">

  <?php
  $sql2 = "SELECT *,DATE_FORMAT(date_of_birth,'%d/%m/%Y') AS dob, DATE_FORMAT(date_of_joining_institute,'%d/%m/%Y') AS doji FROM `staff` WHERE ssn=$ssn;";
  $table = mysqli_query($conn, $sql2);
  while($row = $table->fetch_array()){
    $designation = $row['S_post'];
    $department = $row['dept'];
    $dob = $row['dob'];
    $doji = $row['doji'];
    $qualification = $row['qualification_with_class/grade'];
    $email = $row['S_email'];
    $experience = $row['total_experience_in_years'];
    $paper_published = $row['papers_published'];
    $memberships = $row['professional_memberships'];
    $books = $row['books_published'];
    $awards = $row['awards'];
    echo '<tr class="about_tr"><th class="about_th">designation</th><td class="about_td">'.strtoupper($designation).'</td></tr>';
    echo '<tr class="about_tr"><th class="about_th">department</th><td class="about_td">'.$department.'</td></tr>';
    echo '<tr class="about_tr"><th class="about_th">date of birth</th><td class="about_td">'.$dob.'</td></tr>';
    echo '<tr class="about_tr"><th class="about_th">date of joining the institution</th><td class="about_td">'.$doji.'</td></tr>';
    echo '<tr class="about_tr"><th class="about_th">qualification with class/grade</th><td class="about_td">'.$qualification.'</td></tr>';
    echo '<tr class="about_tr"><th class="about_th">email address</th><td class="about_td">'.$email.'</td></tr>';
    echo '<tr class="about_tr"><th class="about_th">total experience in years</th><td class="about_td">'.$experience.'</td></tr>';

    if($paper_published){
      echo '<tr class="about_tr"><th class="about_th">total papers published</th><td class="about_td">'.$paper_published.'</td></tr>';
    }
    if($memberships){
      echo '<tr class="about_tr"><th class="about_th">professional memberships</th><td class="about_td">'.$memberships.'</td></tr>';
    }
    if($books){
      echo '<tr class="about_tr"><th class="about_th">books published</th><td class="about_td">'.$books.'</td></tr>';
    }
    if($awards){
      echo '<tr class="about_tr"><th class="about_th">awards</th><td class="about_td">'.$awards.'</td></tr>';
    }
    
  }
?>
</table>

</div>

<table id="fdp" class="info">
  <thead>
    <tr class="data_tr">
        <th class="data_th" rowspan="2">SR. No</th>
        <th class="data_th" rowspan="2">Title</th>
        <th class="data_th" rowspan="2">Organizing Agency</th>
        <th class="data_th" rowspan="2">Year</th>
        <th class="data_th" colspan="2">Duration</th>
        <th class="data_th" rowspan="2">Name of Program</th>
    </tr>
    <tr class="data_tr">
      <th class="data_th">start date</th>
      <th class="data_th">end date</th>
    </tr>
  </thead>
<tbody>
  
<?php
  $sr = 1;
  $sql2 = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$dept` WHERE ssn=$ssn AND TYPE='fdp' ORDER BY start_date;";
  $table = mysqli_query($conn, $sql2);
  while($row = $table->fetch_array()){
    
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
    echo '<td class="data_td">'.$tol.'</td>';
    echo '<td class="data_td">'.$pi.'</td>';
    echo '<td class="data_td">'.$year.'</td>';    
    echo '<td class="data_td">'.$sd.'</td>';
    echo '<td class="data_td">'.$ed.'</td>';
    echo '<td class="data_td">'.$nol.'</td>';
    echo '</tr>';
    $sr++; 
  }
?>
</tbody>
</table>
<table id="sttp" class="info">
  <thead>
    <tr class="data_tr">
        <th class="data_th" rowspan="2">SR. No</th>
        <th class="data_th" rowspan="2">Title</th>
        <th class="data_th" rowspan="2">Organizing Agency</th>
        <th class="data_th" rowspan="2">Year</th>
        <th class="data_th" colspan="2">Duration</th>
        <th class="data_th" rowspan="2">Name of Program</th>
    </tr>
    <tr class="data_tr">
      <th class="data_th">start date</th>
      <th class="data_th">end date</th>
    </tr>
  </thead>
<tbody>
  
<?php
  $sr = 1;
  $sql2 = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$dept` WHERE ssn=$ssn AND TYPE='sttp' ORDER BY start_date;";
  $table = mysqli_query($conn, $sql2);
  while($row = $table->fetch_array()){
    
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
    echo '<td class="data_td">'.$tol.'</td>';
    echo '<td class="data_td">'.$pi.'</td>';
    echo '<td class="data_td">'.$year.'</td>';    
    echo '<td class="data_td">'.$sd.'</td>';
    echo '<td class="data_td">'.$ed.'</td>';
    echo '<td class="data_td">'.$nol.'</td>';
    echo '</tr>';
    $sr++; 
}
?>
</tbody>
</table>
<table id="workshop" class="info">
  <thead>
    <tr class="data_tr">
        <th class="data_th" rowspan="2">SR. No</th>
        <th class="data_th" rowspan="2">Title</th>
        <th class="data_th" rowspan="2">Organizing Agency</th>
        <th class="data_th" rowspan="2">Year</th>
        <th class="data_th" colspan="2">Duration</th>
        <th class="data_th" rowspan="2">Name of Program</th>
    </tr>
    <tr class="data_tr">
      <th class="data_th">start date</th>
      <th class="data_th">end date</th>
    </tr>
  </thead>
<tbody>
  
<?php
  $sr = 1;
  $sql2 = "SELECT *,DATE_FORMAT(start_date,'%d/%m/%Y') AS sd, DATE_FORMAT(end_date,'%d/%m/%Y') AS ed FROM `$dept` WHERE ssn=$ssn AND TYPE='workshop' ORDER BY start_date;";
  $table = mysqli_query($conn, $sql2);
  while($row = $table->fetch_array()){
    
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
    echo '<td class="data_td">'.$tol.'</td>';
    echo '<td class="data_td">'.$pi.'</td>';
    echo '<td class="data_td">'.$year.'</td>';    
    echo '<td class="data_td">'.$sd.'</td>';
    echo '<td class="data_td">'.$ed.'</td>';
    echo '<td class="data_td">'.$nol.'</td>';
    echo '</tr>';
    $sr++; 
}
?>
</tbody>
</table>

