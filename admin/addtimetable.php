<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();

include 'connection.php';
if (isset($_POST['SN']) && isset($_POST['TS'])) {
    $arr=explode('*',$_POST['SN']);
    $sid = intval($arr[0]);
    $sname = $arr[1];
    $_SESSION['sid'] = $arr[0];
    $_SESSION['cr'] = $_POST['CR'];
    $_SESSION['TS']=$_POST['TS'];
	$class= $_POST['CR'];
	$timeslot=$_POST['TS'];
	$day= $_SESSION['day'];
	$dept=$_SESSION['dept'];
	$did=$_SESSION['dept_id'];
	$sem=$_SESSION['sem'];
	$cname=$_SESSION['cname'];
	$stype=$_SESSION['stype'];
	$year=$_SESSION['year'];
	echo"Connected";
} else {

    echo "Disconnected";

}

$tq="select tid from teacher where tid in(select tid from subjects where sid=$sid)";

$tr=pg_query($db,$tq);
$tid = pg_fetch_row($tr);

echo "Subject id is ".$sid;
echo "Teacher id is ".$tid[0];
//TODO : TIMESLOT id=0 or Timeslot id=1 does not give the required blockage. Please check this bug in next Update
if($stype == 'PRACTICAL') {
    if($timeslot =='7:30-11:00') {
        $is_timeslot_blocked_query="select timeslot_id from allot where timeslot_id=0 or timeslot_id=1 or timeslot_id=2 or timeslot_id=3";
        $tbq = pg_query($db,$is_timeslot_blocked_query);
        if(!$tbq){
            echo pg_last_error($db);
            exit;
        }
        else if(pg_num_rows($tbq) == 0) {
            $timeslot_id = 0;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'7:30-8:20','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
            $timeslot_id++;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'8:20-9:10','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
            $timeslot_id++;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'9:10-10:00','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
            $timeslot_id++;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'10:10-11:00','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
        }
        else {
            header("Location:gen-time-table-1.php");
        }
    } else if($timeslot =='11:00-1:30') {

        $is_timeslot_blocked_query="select timeslot_id from allot where timeslot_id=4 or timeslot_id=5 or timeslot_id=6";
        $tbq = pg_query($db,$is_timeslot_blocked_query);
        if(!$tbq){
            echo pg_last_error($db);
            exit;
        }
        else if(pg_num_rows($tbq) == 0) {
            $timeslot_id = 4;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'11:00-11:50','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
            $timeslot_id++;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'11:50-12:40','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
            $timeslot_id++;
            $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'12:40-1:30','$day',$timeslot_id,'$year')";
            $ret = pg_query($db, $sql);
        }
        else {
            echo '<script type="text/javascript">';
            echo 'alert("cannot allot");';
            echo 'window.location.href = "gen-time-table-1.php";';
            echo '</script>';

            //header("Location:gen-time-table-1.php");
        }
        /*$sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],$cid[0],'1:30-11:00','$day')";
        $ret = pg_query($db, $sql);*/
    }
    else if($timeslot =='2:40-5:00') {
        $is_timeslot_blocked_query="select timeslot_id from allot where timeslot_id=7 or timeslot_id=8 or timeslot_id=9";
        $tbq = pg_query($db,$is_timeslot_blocked_query);
        if(!$tbq){
            echo pg_last_error($db);
            exit;
        }
        else if(pg_num_rows($tbq) == 0) {
        $timeslot_id=7;
        $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'2:40-3:30','$day',$timeslot_id,'$year')";
        $ret = pg_query($db, $sql);
        $timeslot_id++;
        $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'3:30-4:20','$day',$timeslot_id,'$year')";
        $ret = pg_query($db, $sql);
        $timeslot_id++;
        $sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],'4:20-5:10','$day',$timeslot_id,'$year')";
        $ret = pg_query($db, $sql);
        /*$sql = "insert into allot values ($did[0],'$sem',$sid[0],$tid[0],$cid[0],'10:10-11:00','$day')";
        $ret = pg_query($db, $sql);*/
    } else {
            header("Location:gen-time-table-1.php");

        }

    }

    header("Location:gen-time-table-1.php");

}
else {
    $times = array('7:30-8:20','8:20-9:10','9:10-10:00','10:10-11:00','11:00-11:50','11:50-12:40','12:40-1:30','1:50-2:40','2:40-3:30','3:30-4:20','4:20-5:10');
    $position=array_search($timeslot,$times);
    $timeslot_id=0;
    if(!$position) {
        $timeslot_id=0;
    }
    else {
        $timeslot_id=$position;
    }
    $sql = "insert into allot values ($did,'$sem',$sid,$tid[0],'$timeslot','$day',$timeslot_id,'$year',$class)";


    $ret = pg_query($db, $sql);
    if (!$ret) {
        echo pg_last_error($db);
    } else {


        header("Location:gen-time-table-1.php");
    }

}
pg_close($db);

?>