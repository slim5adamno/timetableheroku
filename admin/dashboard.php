
<?php
setcookie("hello", "HELLO");
?>
<?php
// Print an individual cookie
echo $_COOKIE["hello"];

// Another way to debug/test is to view all cookies
print_r($_COOKIE);
?>
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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="mt-0 font-16">No of Lecturers</h4>
                        <h2 class="text-primary my-4 text-center">
                            <i class="fa fa-user text-dark"></i>
                            <span data-plugin="counterup">
                                <?php
                                include 'connection.php';
                                $sql = "select * from teacher";
                                $result = pg_query($db,$sql);
                                if(!$result) {
                                    echo pg_last_error($db);
                                    exit;
                                }
                                else {
                                    echo pg_num_rows($result);
                                }
                                ?>
                            </span></h2>
                    </div> <!-- end card-box-->
                </div>

                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="mt-0 font-16">No of Courses</h4>
                        <h2 class="text-primary my-4 text-center"><i class="fa fa-cog text-dark"></i>
                            <span data-plugin="counterup">
                                 <?php
                                 include 'connection.php';
                                 $sql = "select * from course";
                                 $result = pg_query($db,$sql);
                                 if(!$result) {
                                     echo pg_last_error($db);

                                     exit;
                                 }
                                 else {
                                     if(pg_num_rows($result)>0)
                                         echo pg_num_rows($result);
                                     else
                                         echo 31234;
                                 }
                                 ?>
                            </span></h2>
                    </div> <!-- end card-box-->
                </div>

                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="mt-0 font-16">No of Students</h4>
                        <h2 class="text-primary my-4 text-center"><i class="fa fa-user text-dark"></i> <span data-plugin="counterup">31,570</span></h2>
                    </div> <!-- end card-box-->
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
<?php
include "includes/footer.php";
?>