<?php
include "includes/header.php";
include "includes/sidebar.php";
?>

<?php

if(session_status() == PHP_SESSION_NONE)
    session_start();
if(isset($_POST['courseName']) && isset($_POST['select_semester'])) {
    $_SESSION['courseName']=$_POST['courseName'];
    $_SESSION['sem']=$_POST['select_semester'];
}
else{
    $_POST['courseName']=$_SESSION['courseName'];
    $_POST['select_semester']=$_SESSION['sem'];
}
?>
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-15">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Time Table</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Time Table</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form method="post">
                <div class="form-inline">
                    <!--<select name="select_department" class="form-control" id="dept">
                        <option disabled="" selected="">--Select Department--</option>
                        <?php
/*

                        include 'connection.php';
                        $sql="select name from department";
                        $ret=pg_query($db,$sql);
                        if(!$ret) {
                            echo pg_last_error($db);
                            exit;
                        }
                        while($row = pg_fetch_row($ret)) {
                            $string .='<option value="'.$row[0].'">'.$row[0].'</option>';
                        }
                        echo $string;
                        pg_close($db);
                        */?>
                    </select>-->



                  <!--  <select name="select_semester" class="form-control">
                        <option selected disabled>--Select Semester--</option>
                        <option value="FY">FY</option>
                        <option value="SY">SY</option>
                        <option value="TY">TY</option>
                    </select>-->
                    <select class="form-control" id="tslot" name="TS"  >
                        <option>--Select TimeSlot--</option>
                        <?php


                        include 'connection.php';
                        $sql="select * from timeslot";

                        $ret=pg_query($db,$sql);
                        if(!$ret) {
                            echo pg_last_error($db);
                            exit;
                        }
                        $string="";
                        while($row = pg_fetch_row($ret)) {
                            $string .='<option value="'.$row[0].'">'.$row[0].'</option>';
                        }
                        echo $string;
                        pg_close($db);
                        ?>


                    </select>


                   <select class="form-control" id="day" name="DAY">
                        <option selected disabled>--Select Day--</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>
                    <button class="btn btn-primary" name="submit">Generate Timetable</button>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-15">
                    <div class="card-box">
                        <div class="row">
                            <div id="content1" class="col-sm-15">

                                <table class="table table-bordered table-sm content nowrap"></center>
                                    <thead >
                                    <?php
                                    include 'connection.php';
                                    //if(isset($_POST['select_department']) && isset($_POST['select_semester'])) {?>
                                        <center><h2>CLASS TIMETABLE FOR <?php if(isset($_SESSION['dept'])){
                                                    echo $_SESSION['dept'];
                                                }?>
                                            </h2></center>

                                        <center><h2>Semester -: <?php if(isset($_POST['select_semester'])){
                                                    echo $_POST['select_semester'];
                                                }?>
                                            </h2></center>

                                        <th style="text-align:center" scope="col">DAYS</th>
                                        <?php
                                        $dept=$_SESSION['dept'];
                                        $sem=$_POST['select_semester'];
                                        $dq="select did from department where name='$dept'";
                                        $dr=pg_query($db,$dq);
                                        $did = pg_fetch_row($dr);
                                        //  $sql="select timeslot from allot where  did=$did[0] and semester='$sem' and day='Monday'";
                                        $sql="select time from timeslot";

                                        $t=pg_query($db,$sql);
                                        $ts=pg_fetch_all($t);
                                        for($i=0;$i<count($ts);$i++)
                                        {
                                            $t= $ts[$i]['time'];
                                            echo "<th style=\"text-align:center\" scope=\"col\" >$t</th>";
                                        }







                                    ?>

                                  <!--  <?php
/*                                    if(isset($_POST['TS']) && isset($_POST['DAY'])) {*/?>
                                        <center><h2>SCHEDULE FOR


                                                <?php /*if(isset($_POST['DAY'])){
                                                    echo $_POST['DAY'];
                                                }*/?>
                                            </h2></center>
                                        <center><h2>TIMESLOT -:
                                                <?php /*if(isset($_POST['TS'])){
                                                    echo $_POST['TS'];
                                                }*/?>
                                            </h2></center>
                                    --><?php /*}
                                    */?>





                                    </thead>
                                    <tbody>
                                    <?php

                                    include 'connection.php';

                                    /* if(isset($_POST['select_department']) && isset($_POST['select_semester'])) {
                                          $dept=$_POST['select_department'];
                                          $sem=$_POST['select_semester'];
                                          $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                         $dq="select did from department where name='$dept'";
                                         $dr=pg_query($db,$dq);
                                         $did = pg_fetch_row($dr);
                                          $sql="select timeslot from allot where  did=$did[0] and semester='$sem' and day='Monday'";
                                          $t=pg_query($db,$sql);
                                         $ts=pg_fetch_all($t);
                                         for($j=0;$j< count($days);$j++)
                                         {
                                          echo "<tr><th>$days[$j]</th>";
                                         for($i=0;$i<count($ts);$i++)
                                         {
                                             $t= $ts[$i]['timeslot'];
                                             $s="select sid from allot where did=$did[0] and semester='$sem' and day='$days[$j]' and timeslot='$t'";
                                             $st=pg_query($db,$s);
                                             $sid=pg_fetch_row($st);
                                             $sq= "select sname from subjects where sid=$sid[0]";
                                             $sqt=pg_query($db,$sq);
                                             $sname=pg_fetch_row($sqt);
                                             echo "<td style=\"text-align:center\" scope=\"row\">$sname[0]</td>";
                                         }
                                         echo "</tr>";
                                         }

                                        }*/

                                   /* CORRECT VERSION USE THIS IF OTHER DOES NOT WORK
                                    *  if(isset($_SESSION['dept']) && isset($_POST['select_semester'])) {
                                        $dept = $_SESSION['dept'];
                                        $sem = $_POST['select_semester'];
                                        $course = $_POST['courseName'];
                                        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                        $times = array('7:30-8:20','8:20-9:10','9:10-10:00','10:10-11:00','11:00-11:50','11:50-12:40','12:40-1:30','1:50-2:40','2:40-3:30','3:30-4:20','4:20-5:10');

                                        for($i=0;$i<count($days);$i++){
                                            echo "<tr><th>$days[$i]</th>";
                                            $time_query = "select timeslot,sname,name from allot,subjects,teacher where allot.did = (select did from department where name='$dept') and allot.semester='$sem' and day='$days[$i]' and allot.cno=(select cno from course where cname='$course') and  allot.sid = subjects.sid and allot.tid=teacher.tid";

                                            $ret = pg_query($db,$time_query);
                                            $ret_arr = pg_fetch_all($ret);

                                            if(pg_num_rows($ret) == 0) {
                                                for($j=0;$j<count($times);$j++) {
                                                    echo "<td style=\"text-align:center\" scope=\"row\">--</td>";
                                                }
                                            }
                                            else {

                                                $counter=0;

                                                $position = array_search($ret_arr[$counter]['timeslot'], $times);

                                                for($j=0;$j<count($times);$j++) {
                                                    if ($j < $position) {
                                                        echo "<td style=\"text-align:center\" scope=\"row\">--</td>";

                                                    } else if ($j == $position) {
                                                        $sub = $ret_arr[$counter]['sname'];
                                                        $teach = $ret_arr[$counter]['name'];


                                                        echo "<td style=\"text-align:center\" scope=\"row\">$sub</br>($teach)</td>";
                                                        $counter++;
                                                        if($counter < pg_num_rows($ret)) {
                                                            $position = array_search($ret_arr[$counter]['timeslot'], $times);
                                                        }

                                                    }
                                                    else {
                                                        echo "<td style=\"text-align:center\" scope=\"row\">--</td>";
                                                    }

                                                }
                                            }
                                            echo "</tr>";
                                        }

                                    }*/
                                    if(isset($_SESSION['dept']) && isset($_POST['select_semester'])) {
                                        $dept = $_SESSION['dept'];
                                        $sem = $_POST['select_semester'];
                                        $course = $_POST['courseName'];
                                        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                        $times = array('7:30-8:20','8:20-9:10','9:10-10:00','10:10-11:00','11:00-11:50','11:50-12:40','12:40-1:30','1:50-2:40','2:40-3:30','3:30-4:20','4:20-5:10');
                                        /*for($i=0;$i<count($days);$i++) {
                                            echo "<tr><th>$days[$i]</th>";
                                            $time_query="select name from allot inner join teacher on allot.tid=teacher.tid and timeslot='$times[$i]'and day='$days[$i]'";
                                            $ret=pg_query($db,$time_query);
                                            $row=pg_fetch_row($ret);


                                        }*/
                                        /*foreach ($days as $day){
                                            echo "<tr><th>$day</th>";
                                            foreach ($times as $t){
                                                $ret=pg_query($db,"select timeslot,sname,stype,name from allot,subjects,teacher where day='$day' and timeslot='$t' and allot.tid=teacher.tid and allot.sid=subjects.sid");
                                                if(pg_num_rows($ret)==0){

                                                }
                                                else {
                                                    $row = pg_fetch_row($ret);
                                                    if($row[2]=='PRACTICAL'){
                                                        echo "<td style=\"text-align:center\" scope=\"row\">$row[1] PRACTICAL</br>$row[2]</td>";
                                                    }
                                                    else {
                                                        echo "<td style=\"text-align:center\" scope=\"row\">$row[1]</br>$row[2]</td>";
                                                    }


                                                }

                                            }

                                        }*/
                                        if(isset($_SESSION['dept']) && isset($_POST['select_semester'])) {
                                            $dept = $_SESSION['dept'];
                                            $sem = $_POST['select_semester'];
                                            $course = $_POST['courseName'];
                                            $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                            $times = array('7:30-8:20','8:20-9:10','9:10-10:00','10:10-11:00','11:00-11:50','11:50-12:40','12:40-1:30','1:50-2:40','2:40-3:30','3:30-4:20','4:20-5:10');

                                            for($i=0;$i<count($days);$i++){
                                                echo "<tr><th>$days[$i]</th>";
                                                $time_query = "select timeslot,sname,name,stype,timeslot_id from allot,subjects,teacher where allot.did = (select did from department where name='$dept') and allot.semester='$sem' and day='$days[$i]' and allot.cno=(select cno from course where cname='$course') and  allot.sid = subjects.sid and allot.tid=teacher.tid order by timeslot_id";

                                                $ret = pg_query($db,$time_query);
                                                $ret_arr = pg_fetch_all($ret);

                                                if(pg_num_rows($ret) == 0) {
                                                    for($j=0;$j<count($times);$j++) {
                                                        echo "<td style=\"text-align:center\" scope=\"row\">--</td>";
                                                    }
                                                }
                                                else {

                                                    $counter=0;

                                                    $position = array_search($ret_arr[$counter]['timeslot'], $times);

                                                    for($j=0;$j<count($times);$j++) {
                                                        if ($j < $position) {
                                                            echo "<td style=\"text-align:center\" scope=\"row\">--</td>";

                                                        } else if ($j == $position) {
                                                            $sub = $ret_arr[$counter]['sname'];
                                                            $teach = $ret_arr[$counter]['name'];
                                                            $stype = $ret_arr[$counter]['stype'];


                                                            echo "<td style=\"text-align:center\" scope=\"row\">$sub</br>$stype</br>($teach)</td>";
                                                            $counter++;
                                                            if($counter < pg_num_rows($ret)) {
                                                                $position = array_search($ret_arr[$counter]['timeslot'], $times);
                                                            }

                                                        }
                                                        else {
                                                            echo "<td style=\"text-align:center\" scope=\"row\">--</td>";
                                                        }

                                                    }
                                                }
                                                echo "</tr>";
                                            }

                                        }

                                    }

                                    if(isset($_POST['TS']) && isset($_POST['DAY'])) {?>

                                        <table id="basic-datatable" class="table dt-responsive table-bordered text-center nowrap">
                                            <thead>
                                            <tr>
                                                <th scope="col">Department</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Teacher</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Classroom</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            include 'connection.php';

                                            $dp=$_POST['TS'];
                                            $se=$_POST['DAY'];


                                            $sql = "Select * from allot where timeslot='$dp' and day='$se'";

                                            $ret = pg_query($db, $sql);
                                            if (!$ret) {
                                                echo pg_last_error($db);
                                                exit;
                                            }
                                            while ($row = pg_fetch_row($ret)) {
                                                $sq= "select sname from subjects where sid=$row[2]";
                                                $tq="select name from teacher where tid=$row[3]";
                                                $dq="select name from department where did=$row[0]";


                                                $sr=pg_query($db,$sq);
                                                $tr=pg_query($db,$tq);
                                                $dr=pg_query($db,$dq);


                                                $sid = pg_fetch_row($sr);
                                                $tid = pg_fetch_row($tr);
                                                $did = pg_fetch_row($dr);

                                                echo "<tr><th scope=\"row\">{$did[0]}</th>
                        <td>{$row[1]}</td>
                        <td>{$sid[0]}</td>
                        <td>{$tid[0]}</td>
                        <td>{$row[4]}</td>" ?>

                                                <?php
                                            }
                                            pg_close($db);
                                            ?>
                                            </tbody>
                                        </table>


                                    <?php	}

                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-box-->
                    </div>
                </div>
                <button id="cmd" class="btn btn-success cmd">Download Time-Table</button>
            </div>
        </div>
    </div>
</div> <!-- container -->
</div> <!-- content -->
<?php
include "includes/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script>
    $(function(){
        let doc = new jsPDF('p','pt','a4');
        $("#cmd").click(function(){
            doc.addHTML(document.getElementById('content1'),function() {
                doc.save('Time-Table.pdf');
            })
        });
    })
</script>
<style type="text/css">
    .time-text{
        text-align: center;
        font-weight: bold;
    }

    table th{
        text-align: center;
    }
    table tr{
        text-align: center;
        font-weight: bold;
    }
    .table-sm td, .table-sm th {
        padding: 0.3rem;
        margin: 1rem;
    }
    .content{
        background-color: white !important;
    }

</style>