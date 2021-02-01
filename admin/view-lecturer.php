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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Lecturer</a></li>
                                <li class="breadcrumb-item active">View Lecturer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Lecturer</h4>
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
                                    if(!$ret) {
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
                       <td><a href="deleteteacher.php?d_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

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