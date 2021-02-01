<?php
include "includes/header.php";
include "includes/sidebar.php";
?>
<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
if(isset($_POST['TDP']) && isset($_POST['CTYPE']) && isset($_POST['STYPE'])) {
    $_SESSION['dept']=$_POST['TDP'];
    $_SESSION['ctype']=$_POST['CTYPE'];
    $_SESSION['stype']=$_POST['STYPE'];
}
else{

    $_POST['TDP']=$_SESSION['dept'];
    $_POST['CTYPE']=$_SESSION['ctype'];
    $_POST['STYPE']=$_SESSION['stype'];
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
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Assign TIMETABLE</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Assign TIMETABLE</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="view-time-table-step2.php">
                                        <!--<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="day">Day</label>
                                                    <select class="form-control" id="day" name="DAY" required >
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                    </select>
                                                </div>
                                            </div>-->
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label>Select Course</label>
                                                <select class="form-control" id="course" name="courseName" required>
                                                    <?php


                                                    include 'connection.php';
                                                    $dn=$_POST['TDP'];
                                                    $ct=$_POST['CTYPE'];
                                                    $sql="select cname from course where did=(select did from department where name='$dn') and ctype='$ct'";

                                                    $ret=pg_query($db,$sql);
                                                    if(!$ret) {
                                                        echo pg_last_error($db);
                                                        exit;
                                                    }
                                                    $string = '<option selected disabled>Select</option>';
                                                    while($row = pg_fetch_row($ret)) {
                                                        $string .='<option value="'.$row[0].'">'.$row[0].'</option>';
                                                    }
                                                    echo $string;
                                                    pg_close($db);
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-12">
                                             <div class="form-group">
                                                 <label>Select Semester</label>
                                                 <select class="form-control" id="semester" name="SEM" required>
                                                 <option selected disabled>Select</option>
                                                 <option value="FY">FY</option>
                                                 <option value="SY">SY</option>
                                                 <option value="TY">TY</option>
                                                  </select>
                                             </div>
                                         </div>-->
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label>Select Semester</label>
                                        <select name="select_semester" class="form-control">
                                            <option selected disabled>--Select Semester--</option>
                                            <option value="FY">FY</option>
                                            <option value="SY">SY</option>
                                            <option value="TY">TY</option>
                                        </select></div></div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-block btn-info rounded-0" name="add_course">Add Course</button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->




        </div> <!-- container -->

    </div> <!-- content -->

    <?php
    include "includes/footer.php";
    ?>




