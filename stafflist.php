
<?php
    require_once('pdo.php');

    if(isset($_GET["search"])){
        $serach = $_GET['search'];
        $sql="SELECT * FROM `staff` WHERE S_name LIKE '%$serach%'";
    }
    else{
        if($dept == "All Staff"){
            $sql="SELECT * FROM `staff` ORDER BY `S_post` DESC";
        }
        else{
            $sql ="SELECT * FROM `staff` WHERE dept= :dept";

        }
    }
    //echo $sql;
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':dept' => $dept)
    );

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach( $rows as $row ) {
        $ssn = $row['ssn'];
        $sname = $row['S_name'];
        $spost = $row['S_post'];
        $semail = $row['S_email'];
        echo '<div class="card"><a href="pg2.php?ssn='.htmlentities($ssn).'" target="_blank">
                <div class="image">
                    <img src="showimg.php?ssn='.htmlentities($ssn).'">
                </div>
                <div class="title">
                   <h3 class="teacher_name">'.htmlentities($sname).'</h3>
                </div>
                <div class="des">
                    <p >'.htmlentities(strtoupper($spost)).'<br>'.htmlentities($semail).'</p>
                </div>
                </a></div>';
    }
    

?>
