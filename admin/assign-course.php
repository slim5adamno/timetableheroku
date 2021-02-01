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
                                <li class="breadcrumb-item active">Assign Course</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Assign Course</h4>
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
                                    <form method="post" action="gen-time-table.php">
                                    <div class="row">
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
                                        </div>
                                        <div class="col-md-12">
                                       
                                            <div class="form-group">
                                                <label>Select Department</label>
                                                <select class="form-control" id="tdepartment" name="TDP" required>
                                                    <?php


                                                include 'connection.php';
                                                $sql="select name from department";

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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Course Type</label>
                                                <select class="form-control" id="courseType" name="CTYPE" required>
                                                    <option selected disabled>Select</option>
                                                    <!--<option value="THEORY">THEORY</option>
                                                    <option value="PRACTICAL">PRACTICAL</option>-->
                                                    <option value="UG">UG</option>
                                                    <option value="PG">PG</option>
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
                                                <label>Select Type</label>
                                                <select class="form-control" id="stype" name="STYPE" required>
                                                    <option selected disabled>Select</option>
                                                    <option value="THEORY">Theory</option>
                                                    <option value="PRACTICAL">Practical</option>
                                                </select>
                                            </div>
                                        </div>
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



