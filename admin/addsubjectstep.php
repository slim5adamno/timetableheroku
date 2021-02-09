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
                                    <li class="breadcrumb-item active">Add/Modify Subject</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Add/Modify Subject</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!--<div class="row">-->
                                <div class="col-lg-12">
                                    <form method="post" action="addsubjectstep1.php">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <!--<div class="form-group">
                                                    <label for="subjectcode">Subject Code</label>
                                                    <input type="text" class="form-control" id="subjectcode" name="SC" placeholder="Subject Code ...">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="subjectname">Subject's Name</label>
                                                    <input type="text" class="form-control" id="subjectname" name="SN" placeholder="Subject's Name ...">
                                                </div>
                                            </div>-->
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
                                                        <label>Course Type</label>
                                                        <select class="form-control" id="ctype" name="CTYPE" required>
                                                            <option selected disabled>Select</option>
                                                            <option value="UG">UG</option>
                                                            <option value="PG">PG</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-block btn-info rounded-0" name="subject_details">Add Subject Details</button>
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
                                    <th scope="col">Subject code</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Subject Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'connection.php';

                                $sql = "Select * from subjects";
                                $ret = pg_query($db, $sql);
                                if (!$ret) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                while ($row = pg_fetch_row($ret)) {

                                    // $sql="select name from department where did='$row[3]'";



                                    $return = pg_query($db, $sql);
                                    if(!$return) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id =pg_fetch_row($return);

                                    }
                                    $sql2="select name from department where did=$id[5]";
                                    $return2=pg_query($db,$sql2);
                                    if(!$return2) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id2 =pg_fetch_row($return2);

                                    }

                                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                        <td>  {$row[1]}</td>
                        <td>  {$row[6]}</td>
                        <td>  {$row[2]}</td>  
                        <td>  {$id2[0]}</td>
                        <td>  {$row[3]}</td>
                                       
                        " ?>



                                    <td><a href="deletesubject.php?c_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>


                                <?php }
                                pg_close($db);
                                ?>
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