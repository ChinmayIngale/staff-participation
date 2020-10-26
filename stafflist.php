
<?php
    require_once('pdo.php');

    $sql ="SELECT * FROM `staff` WHERE dept= :dept";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':dept' => $_POST['dept'])
    );
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach( $rows as $row ) {
        $ssn = $row['ssn'];
        $sname = $row['S_name'];
        $spost = $row['S_post'];
        $semail = $row['S_email'];
        echo '<div class="card"><a href="staffinfo.php?ssn='.htmlentities($ssn).'" target="_blank">
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
