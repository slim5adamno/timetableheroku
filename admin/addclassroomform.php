<?php

include 'connection.php';
if (isset($_POST['CN']) && isset($_POST['TDP']) && isset($_POST['SEM']) && isset($_POST['YEAR']) &&isset($_POST['TIME'])) {
    
    $cno = $_POST['CN'];
    $dept = $_POST['TDP'];
    $sem = $_POST['SEM'];
    $year = $_POST['YEAR'];
    $time = $_POST['TIME'];
   
} else {

    die();
}

$sql="select did from department where did='$dept'";


$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {
    $id =pg_fetch_row($ret);

}

$ret3 = pg_query($db,"select * from classroom where cno=$cno");
$num_row = pg_num_rows($ret3);
if($num_row == 0) {
    $sql1 = "insert into classroom values($cno)";
    $ret1 = pg_query($db,$sql1);
    if(!$ret1){
        echo pg_last_error($db);
    }
    $sql2 = "insert into classroom_allot values($cno,$id[0],'$year','$sem','$time')";

    $ret2 = pg_query($db,$sql2);
    if(!$ret2){
        echo pg_last_error($db);
    }

    header('Location:venue.php');
}
else {
    $num_rows = 0;

    $sql3 = "select * from classroom_allot where cno=$cno";
    $ret3 = pg_query($db,$sql3);
    if(!$ret3){
        echo pg_last_error($db);
    }
    else {
        $row2 = pg_fetch_row($ret3);
        $num_rows = pg_num_rows($ret3);
    }
    if($num_rows == 2) {
        echo "Cannot allot as Both Monday and Afternoon session is alloted to classroom. Please Recheck:<br/> <a href='venue.php'>Go back</a>";
    }
    else {
        if($time == $row2[4]){
            echo "Cannot allot as time is already alloted to classroom. Please check and reenter<br/> <a href='venue.php'>Go back</a>";
        }
        else{
            $sql2 = "insert into classroom_allot values($cno,$id[0],'$year','$sem','$time')";

            $ret2 = pg_query($db, $sql2);
            if (!$ret2) {
                echo pg_last_error($db);
            } else {
                header('Location:venue.php');
            }
        }

    }

}
pg_close($db);

?>