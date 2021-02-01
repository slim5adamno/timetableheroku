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
                                <li class="breadcrumb-item active">Add/Modify Course</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add/Modify Course</h4>
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
                                    <form method="post" action="add_courseform.php">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="courseid">Enter course id</label>
                                                    <input type="number" class="form-control" id="courseid" name="course_id" placeholder="Course id ..." required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="coursename">Course's Name</label>
                                                    <input type="text" class="form-control" id="coursename" name="course_name" placeholder="course's Name ..." required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
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
                                                    <label>Department</label>
                                                    <select class="form-control" id="tdepartment" name="TDP" required >
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



                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th scope="col">Course code</th>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Course Type</th>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Stream</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'connection.php';

                                $sql = "Select * from course ORDER BY cno";
                                $ret = pg_query($db, $sql);
                                if (!$ret) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                while ($row = pg_fetch_row($ret)) {

                                    $sql1="select * from department where did=$row[3]";


                                    $return = pg_query($db, $sql1);
                                    if(!$return) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id =pg_fetch_row($return);

                                    }

                                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                        <td>{$row[1]}</td>
                        <td>{$row[2]}</td>
                        <td>{$id[1]}</td>
                        <td>{$id[2]}</td>" ?>



                                    <td><a href="delete_course.php?c_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>


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