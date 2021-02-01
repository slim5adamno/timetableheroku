<?php
include "includes/header.php";
include "includes/sidebar.php";
?>
<?php
if(session_status() == PHP_SESSION_NONE)
    session_start();
if(isset($_POST['TDP']) && isset($_POST['CTYPE'])) {
    $_SESSION['dept']=$_POST['TDP'];
    $_SESSION['ctype']=$_POST['CTYPE'];
}
else{

    $_POST['TDP']=$_SESSION['dept'];
    $_POST['CTYPE']=$_SESSION['ctype'];
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
                           <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="addsubjectstep2.php">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Course Name</label>
                                                    <select class="form-control" id="ctype" name="CNAME" required>

                                                        <?php


                                                        include 'connection.php';
                                                        // $sql="select name from teacher where did=(select did from department where name='$_SESSION[dept]')";
                                                        $sql="select cname from course where ctype='$_SESSION[ctype]' and did=(select did from department where name='$_SESSION[dept]')";

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
                                                    <label>Semester</label>
                                                    <select class="form-control" id="semester" name="SEM" required>
                                                        <option selected disabled>Select</option>
                                                        <option value="FY">FY</option>
                                                        <option value="SY">SY</option>
                                                        <option value="TY">TY</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">

                                                <div class="form-group">
                                                    <label for="subjectcode">Subject Code</label>
                                                    <input type="text" class="form-control" id="subjectcode" name="SC" placeholder="Subject Code ..." required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="subjectname">Subject's Name</label>
                                                    <input type="text" class="form-control" id="subjectname" name="SN" placeholder="Subject's Name ..." required>
                                                </div>
                                            </div>
                                                <!--<div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Department</label>
                                                        <select class="form-control" id="tdepartment" name="TDP" required >
                                                            <?php
/*

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
                                                            */?>


                                                        </select>
                                                    </div>
                                                </div>-->

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Teacher</label>
                                                    <select class="form-control" id="tname" name="TNAME" required >
                                                        <?php


                                                        include 'connection.php';
                                                        $sql="select name from teacher where did=(select did from department where name='$_SESSION[dept]')";



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
                                                    <label>Subject Type</label>
                                                    <select class="form-control" id="stype" name="STYPE" required>
                                                        <option selected disabled>Select</option>


                                                        <option value="THEORY">THEORY</option>
                                                        <option value="PRACTICAL">PRACTICAL</option>
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
                                    <th scope="col">Subject code</th>
                                    <th scope="col">Subject Name</th>
                                    <th scope="col">Subject Type</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'connection.php';

                                $sql = "Select * from subjects inner join course on subjects.cno=course.cno inner join department on course.did=department.did and department.did=(select did from department where name='$_SESSION[dept]') and course.ctype='$_SESSION[ctype]'";
                                $ret = pg_query($db, $sql);
                                if (!$ret) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                while ($row = pg_fetch_row($ret)) {

                                   // $sql="select name from department where did='$row[3]'";
                                    $sql1="select did,cname from course where cno='$row[5]'";



                                    $return = pg_query($db, $sql);
                                    $return1=pg_query($db,$sql1);
                                    if(!$return) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id =pg_fetch_row($return);

                                    }
                                    if(!$return1) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id1 =pg_fetch_row($return1);

                                    }
                                    $sql2="select name from department where did=$id1[0]";
                                    $return2=pg_query($db,$sql2);
                                    if(!$return2) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id2 =pg_fetch_row($return2);

                                    }

                                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                        <td>{$row[1]}</td>
                        <td>{$row[3]}</td>
                        <td>{$row[2]}</td>
                        <td>{$id1[1]}</td>
                        <td>{$id2[0]}</td>" ?>



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