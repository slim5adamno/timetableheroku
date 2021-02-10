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
                                <li class="breadcrumb-item active">Add/Modify Department</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add/Modify Department</h4>
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
                                    <form method="post" action="adddepartmentform.php">
                                    <div class="row">
                                        <div class="col-md-12">  
                                            <div class="form-group">
                                               


                                                <label>Department Number</label>
                                                 <?php
                                                    include 'connection.php';

                                                    $sql = "Select * from department" ;
                                                        $ret = pg_query($db, $sql);
                                                    if (!$ret) {
                                                        echo pg_last_error($db);
                                                            exit;
                                                            }
                                                    $num_rows = pg_num_rows($ret);
                                                    $num_rows++;
                                                    echo "<input type=\"number\" class=\"form-control\" name=\"DNO\" placeholder=\"\" value=\"$num_rows\" required>"
                                                    ?>
                                            </div>
                                        </div>
                                                <!--<input type="number" class="form-control" name="DNO" placeholder="" required>-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Stream</label>
                                                <select class="form-control" name="STREAM" required>
                                                    <option selected="" disabled="">Select Stream</option>
                                                    <option value="ARTS">ARTS</option>
                                                    <option value="COMMERCE">COMMERCE</option>
                                                    <option value="SCIENCE">SCIENCE</option>

                                                    <option value="VOCATIONAL">VOCATIONAL</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Department Name</label>
                                                <input type="text" class="form-control" name="DN" placeholder="" required>

                                                <label>Course Type</label>
                                                <select class="form-control" id="coursetype" name="course_type" required>
                                                    <option selected disabled>Select</option>
                                                    <option value="UG">UG</option>
                                                    <option value="PG">PG</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Classroom Number</label>
                                                <select class="form-control" id="cno" name="CNO" required >
                                                    <?php


                                                    include 'connection.php';
                                                    $sql="select * from classroom where cno not in(select cno from department)";


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
                                               <button class="btn btn-block btn-info rounded-0" name="add_dept">Add Department</button> 
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            

            
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th >Department No.</th>
                                        <th>Stream</th>
                                         <th >Department Name</th>
                                        <th> Classroom No.</th>
                                         <th >Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                    include 'connection.php';

                                                    $sql = "Select * from department" ;
                                                        $ret = pg_query($db, $sql);
                                                    if (!$ret) {
                                                        echo pg_last_error($db);
                                                            exit;
                                                            }
                                                    while ($row = pg_fetch_row($ret)) {
                                                        echo "<tr><th scope=\"row\">{$row[0]}</th>
                                                        <td>{$row[2]}</td><td>{$row[1]}</td><td>{$row[3]}</td>"; ?>

                                                       
                                                        <td><a href="deletedepartment.php?dept_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

                                                  <?php  } ?>
                                    
                              
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

    <?php
    include "includes/footer.php";
    ?>