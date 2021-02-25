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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Department</a></li>
                                <li class="breadcrumb-item active">View Department</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Department</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                <tr>
                                    <th >Department No.</th>
                                    <th>Stream</th>
                                    <th >Department Name</th>
                                    <th >Course Type</th>
                                    <th> Classroom No.</th>
                                    <th> Update</th>
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
                                    echo "<tr><th scope=\"row\" style=\"text-align:center\">{$row[0]}</th>
                                                        <td style=\"text-align:center\">{$row[2]}</td><td style=\"text-align:center\">{$row[1]}</td><td style=\"text-align:center\">{$row[3]}</td><td style=\"text-align:center\">{$row[4]}</td>"; ?>

                                    <td style=\"text-align:center\"><a href="updatedepartment.php?dept_id=<?php echo $row[0]?>" class="btn btn-danger"> Update Department</a></td>

                                    <td style=\"text-align:center\"><a href="deletedepartment.php?dept_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

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