<?php
include "includes/header.php";
include "includes/sidebar.php";
?>

<?php
if($_GET['t_id'])
{
    $teacher_id=$_GET['t_id'];

}
else{
    die("error : Department id not set");
}
?>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Lecturer</a></li>
                                <li class="breadcrumb-item active">Update Lecturer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Update Lecturer</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">

                                    <form method="post" action="updateteacherform.php">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="TF">Faculty No</label>
                                                    <?php
                                                        echo "<input type=\"number\" class=\"form-control\" id=\"facultyno\" name=\"TF\" placeholder=\"Faculty No ...\" value = \"$teacher_id\" required readonly>";
                                                    ?>
                                                    <!--<input type="number" class="form-control" id="facultyno" name="TF" placeholder="Faculty No ..." required>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="teachername">Teacher's Name</label>
                                                    <?php
                                                    include 'connection.php';

                                                    $sql = "Select * from teacher where tid=$teacher_id";
                                                    $ret = pg_query($db, $sql);
                                                    if (!$ret) {
                                                        echo pg_last_error($db);
                                                        exit;
                                                    }
                                                    $row = pg_fetch_row($ret);
                                                    echo "<input type=\"text\" class=\"form-control\" id=\"teachername\" name=\"TN\" value=\"$row[1]\" required>"
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="teacheremailid">Email-ID</label>
                                                    <?php
                                                    include 'connection.php';

                                                    $sql = "Select * from teacher where tid=$teacher_id";
                                                    $ret = pg_query($db, $sql);
                                                    if (!$ret) {
                                                        echo pg_last_error($db);
                                                        exit;
                                                    }
                                                    $row = pg_fetch_row($ret);
                                                    echo "<input type=\"email\" class=\"form-control\" id=\"teacheremailid\" name=\"TE\" value=\"$row[4]\" required>"
                                                    ?>
                                                   <!-- <input type="email" class="form-control" id="teacheremailid" name="TE" placeholder="abc@gmail.com ..." required>-->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="teachercontactnumber">Contact No.</label>
                                                    <?php
                                                    include 'connection.php';

                                                    $sql = "Select * from teacher where tid=$teacher_id";
                                                    $ret = pg_query($db, $sql);
                                                    if (!$ret) {
                                                        echo pg_last_error($db);
                                                        exit;
                                                    }
                                                    $row = pg_fetch_row($ret);
                                                    echo "<input type=\"tel\" class=\"form-control\" id=\"teachercontactnumber\" name=\"TP\" value=\"$row[3]\" minlength=\"10\" maxlength=\"10\" pattern=\"[7-9]{1}[0-9]{9}\" required>"
                                                    ?>
                                                    <!--<input type="tel" class="form-control" id="teachercontactnumber" name="TP" placeholder="+91 " minlength="10" maxlength="10" pattern="[7-9]{1}[0-9]{9}" required>-->
                                                </div>
                                            </div>


                                            <!--<div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="form-control" id="tdepartment" name="TDP" required >


                                                        <option selected="" disabled="">Select Department</option>
                                                        <?php
                                                       /* include 'connection.php';
                                                        $sql="Select * from department order by name";




                                                        $ret=pg_query($db,$sql);
                                                        if(!$ret) {
                                                            echo pg_last_error($db);
                                                            exit;
                                                        }

                                                        $string = "<option selected disabled>Select</option>";
                                                        while($row = pg_fetch_row($ret)) {
                                                            $string .= "<option value=\"$row[0]\"> $row[1] ----- $row[2] ----- $row[3]</option>;";
                                                        }
                                                        echo $string;
                                                        pg_close($db);*/
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <select class="form-control" name="TD">
                                                        <?php
                                                        include 'connection.php';

                                                        $sql = "Select * from teacher where tid=$teacher_id";
                                                        $ret = pg_query($db, $sql);
                                                        if (!$ret) {
                                                            echo pg_last_error($db);
                                                            exit;
                                                        }
                                                        $row = pg_fetch_row($ret);
                                                        echo "<option selected=\"$row[2]\">$row[2]</option>"
                                                        ?>
                                                        <option value="Lecturer">Lecturer</option>
                                                        <option value="Professor">Professor</option>
                                                        <option value="Assistant Professor">Assistant Professor</option>
                                                        <option value="Associate Professor">Associate Professor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button class="btn btn-block btn-info rounded-0" name="register">Update Lecturer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th scope="col">Faculty No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Contact No.</th>
                                    <th scope="col">Email ID</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'connection.php';

                                $sql = "Select * from teacher order by tid ";

                                $ret = pg_query($db, $sql);
                                if (!$ret) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                while ($row = pg_fetch_row($ret)) {

                                    $sql="select name from department where did=$row[5]";

                                    $return = pg_query($db, $sql);
                                    if(!$return) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id =pg_fetch_row($return);

                                    }

                                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                        <td>{$row[1]}</td>
                        <td>{$row[2]}</td>
                        <td>{$id[0]}</td>
                        <td>{$row[3]}</td>
                        <td>{$row[4]}</td>"; ?>
                                    <td><a href="updateteacher.php?t_id=<?php echo $row[0]?>" class="btn btn-info"><i class="fa fa-pencil-alt"></i> Update</a></td>
                                    <td><a href="deleteteacher.php?t_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

                                    <?php
                                }
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

