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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Allot</a></li>
                                <li class="breadcrumb-item active">View Lecturer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Allotment</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Department No.</th>
                                    <th scope="col">Department Name</th>
                                    <th scope="col">Subject name</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Timeslot</th>
                                    <th scope="col">Classroom No.</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include 'connection.php';

                                $sql = "Select * from allot order by did";

                                $ret = pg_query($db, $sql);
                                if (!$ret) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                while ($row = pg_fetch_row($ret)) {

                                    $sql="select name from department where did=$row[0]";
                                    $sql1="select sname from subjects where did=$row[2]";

                                    $return = pg_query($db, $sql);
                                    $return1 = pg_query($db, $sql1);
                                    if(!$return || !$return1) {
                                        echo pg_last_error($db);
                                    } else {
                                        $id =pg_fetch_row($return);
                                        $sid =pg_fetch_row($return1);

                                    }

                                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                        <td style=\"text-align:center\">{$id[0]}</td>
                        <td style=\"text-align:center\">{$sid[0]}</td>
                        <td style=\"text-align:center\">{$row[7]}</td>
                        <td style=\"text-align:center\">{$row[1]}</td>
                        <td style=\"text-align:center\">{$row[4]}</td>
                        <td style=\"text-align:center\">{$row[8]}</td>"; ?>
                                    <td><a href="delete_ttable.php?d_id=<?php echo $row[0]?>&sem=<?php echo $row[1]?>&sid=<?php echo $row[2]?>&tid=<?php echo $row[3]?>&day=<?php echo $row[5]?>&timeslot_id=<?php echo $row[6]?>&year=<?php echo $row[7]?>&cno=<?php echo $row[8]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

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