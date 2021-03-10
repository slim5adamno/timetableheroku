<?php
include "includes/header.php";
include "includes/sidebar.php";
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
                <div class="col-12">
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
                    <select name="select_department" class="form-control" id="dept">
                        <option disabled="" selected="">--Select Department--</option>
                        <?php


                        include 'connection.php';
                        $sql="select name,stream from department order by stream";
                        $ret=pg_query($db,$sql);
                        if(!$ret) {
                            echo pg_last_error($db);
                            exit;
                        }
                        while($row = pg_fetch_row($ret)) {
                            $string .='<option value="'.$row[0].'">'.$row[0]. '&nbsp;'. '&#8212;'. '&nbsp;'.$row[1].'</option>';
                        }
                        echo $string;
                        pg_close($db);
                        ?>
                    </select>



                    <select name="select_year" class="form-control">
                        <option selected disabled>--Select Year--</option>
                        <option value="FY">FY</option>
                        <option value="SY">SY</option>
                        <option value="TY">TY</option>
                    </select>

                    <select name="select_semester" class="form-control">
                        <option selected disabled>--Select Semester--</option>
                        <option value="SEM I">SEM I</option>
                        <option value="SEM II">SEM II</option>
                    </select>

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
                <div class="col-xl-12">
                    <div class="card-box">
                        <div class="row">
                            <div id="content" class="col-md-12">

                                <!--<div class="scrollme">-->
                                <table class="table table-responsive table-bordered content"></center>
                                    <thead >
                                    <?php

                                    include 'connection.php';

                                    if(isset($_POST['select_department']) && isset($_POST['select_semester'])&& isset($_POST['select_year'])) {?>
                                        <center><h2>CLASS TIMETABLE FOR <?php if(isset($_POST['select_department'])){
                                                    echo $_POST['select_department'];
                                                }?> </h2></center>
                                        <center><h2>Year -: <?php if(isset($_POST['select_year'])){
                                                    echo $_POST['select_year'];
                                                }?> </h2></center>
                                        <center><h2>Semester -: <?php if(isset($_POST['select_semester'])){
                                                    echo $_POST['select_semester'];
                                                }?> </h2></center>

                                        <th style="text-align:center" scope="col">DAYS</th>
                                        <?php
                                        $dept=$_POST['select_department'];
                                        $year=$_POST['select_year'];
                                        $sem=$_POST['select_semester'];
                                        $dq="select did from department where name='$dept'";
                                        $dr=pg_query($db,$dq);
                                        $did = pg_fetch_row($dr);

                                        //$sql="select timeslot from allot where  did=$did[0] and semester='$sem' and day='Monday'";
                                        $sql="select time from timeslot";
                                        $t=pg_query($db,$sql);
                                        $ts=pg_fetch_all($t);
                                        for($i=0;$i<count($ts);$i++)
                                        {
                                            $t= $ts[$i]['time'];
                                            echo "<th style=\"text-align:center\" scope=\"col\">$t</th>";
                                        }




                                    }


                                    ?>
                                    <?php
                                    if(isset($_POST['TS']) && isset($_POST['DAY'])) {?>
                                        <center><h2>SCHEDULE FOR <?php if(isset($_POST['DAY'])){
                                                    echo $_POST['DAY'];
                                                }?>
                                            </h2></center>
                                        <center><h2>TIMESLOT -: <?php if(isset($_POST['TS'])){
                                                    echo $_POST['TS'];
                                                }?> </h2></center>
                                    <?php }
                                    ?>





                                    </thead>
                                    <tbody>
                                    <?php

                                    include 'connection.php';

                                    if(isset($_POST['select_department']) && isset($_POST['select_semester'])&& isset($_POST['select_year'])) {
                                        $dept=$_POST['select_department'];
                                        $sem=$_POST['select_semester'];
                                        $year=$_POST['select_year'];
                                        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                        $times = array('7:30-8:20','8:20-9:10','9:10-10:00','10:10-11:00','11:00-11:50','11:50-12:40','12:40-1:30','1:50-2:40','2:40-3:30','3:30-4:20','4:20-5:10');

                                        /*$dq="select did from department where name='$dept'";
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
                                        }*/


                                        for($i=0;$i<count($days);$i++){
                                            echo "<tr><th>$days[$i]</th>";
                                            $time_query = "select timeslot,sname,name,stype,timeslot_id,allot.cno from allot,subjects,teacher where allot.did = (select did from department where name='$dept') and allot.semester='$sem' and allot.year='$year' and day='$days[$i]' and  allot.sid = subjects.sid and allot.tid=teacher.tid order by timeslot_id";

                                            $ret = pg_query($db,$time_query);
                                            $ret_arr = pg_fetch_all($ret);
                                            //print_r($ret_arr);

                                            $number_of_entries = array_count_values(array_column($ret_arr, 'timeslot'));

                                            //print_r($number_of_entries);
                                            if(pg_num_rows($ret) == 0) {
                                                for($j=0;$j<count($times);$j++) {
                                                    echo "<td style=\"text-align:center\" scope=\"row\">--</td>";
                                                }
                                            }
                                            else {
                                                $counter=0;

                                                $teachers = "";
                                                $stype = "";
                                                $position = array_search($ret_arr[$counter]['timeslot'], $times);

                                                for($j=0;$j<count($times);$j++) {
                                                    $subjects = "";
                                                    if ($j < $position) {
                                                        echo "<td style=\"text-align:center\" scope=\"row\">--</td>";

                                                    } else if ($j == $position) {
                                                        $count = 1;
                                                        $sub = $ret_arr[$counter]['sname'];
                                                        $teach = $ret_arr[$counter]['name'];
                                                        $stype = $ret_arr[$counter]['stype'];
                                                        $subjects = $sub . "</br>" . $teach . "</br>".$ret_arr[$counter]['cno']."</br>"."-----";
                                                        $c = $number_of_entries[$times[$position]];
                                                        while($count < $c){
                                                            $subjects .= "</br>".$ret_arr[$count]['sname'];
                                                            $subjects .= "</br>".$ret_arr[$count]['name'] . "</br>".$ret_arr[$count]['cno']."</br>"."------";
                                                            $count++;
                                                        }

                                                        $count = 0;
                                                        echo "<td style=\"text-align:center\" scope=\"row\">$subjects</br></td>";
                                                        $c = $number_of_entries[$times[$position]];
                                                        $counter = $counter + $c;
                                                        if($counter < pg_num_rows($ret)) {
                                                            $position = array_search($ret_arr[$counter]['timeslot'], $times);
                                                        }

                                                    }
                                                    else {
                                                        echo "<td style=\"text-align:center\" scope=\"row\">+</td>";
                                                    }

                                                }
                                            }
                                            echo "</tr>";
                                        }
                                    }
                                    if(isset($_POST['TS']) && isset($_POST['DAY'])) {?>

                                        <table id="basic-datatable" class="table dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th scope="col">Department</th>
                                                <th scope="col">Stream</th>
                                                <th scope="col">Teacher</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Subject Type</th>
                                                <th scope="col">Classroom</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Semester</th>

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
                                                $sq= "select sname,stype from subjects where sid=$row[2]";
                                                $tq="select name from teacher where tid=$row[3]";
                                                $dq="select name,stream from department where did=$row[0]";
                                                $cn="select cno from classroom_allot where did=$row[0] and year='$row[7]' and semester='$row[1]'";



                                                $sr=pg_query($db,$sq);
                                                $tr=pg_query($db,$tq);
                                                $dr=pg_query($db,$dq);
                                                $cr=pg_query($db,$cn);

                                                $sid = pg_fetch_row($sr);
                                                $tid = pg_fetch_row($tr);
                                                $did = pg_fetch_row($dr);
                                                $cid = pg_fetch_row(($cr));

                                                echo "<tr><th scope=\"row\">{$did[0]}</th>

                        <td>{$did[1]}</td>            
                        <td>{$tid[0]}</td>
                        
                        <td>{$sid[0]}</td>
                        <td>{$sid[1]}</td>

                        <td>{$row[8]}</td>
                        <td>{$row[7]}</td>
                        <td>{$row[1]}</td>  " ?>

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
                                <!--</div>-->
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
            doc.addHTML(document.getElementById('content'),function() {
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
    .content{
        background-color: white !important;
    }
    .scrollme {
        overflow-x: auto;
    }

</style>