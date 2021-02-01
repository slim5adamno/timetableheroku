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
                                <li class="breadcrumb-item active">Add/Modify Venue</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add/Modify Venue</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="addclassroomform.php">
                                <div class="row">
                                    
                                    <div class="col-md-12">  
                                       
                                        <div class="form-group">
                                        <label for="CN">Classroom's Name</label>
                                        <input type="text" class="form-control" id="classroomname" name="CN" placeholder="Classroom's Name ...">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">  
                                        <div class="form-group">
                                           <button type="submit" class="btn btn-block btn-info rounded-0" id="submit" name="add-venue">Add Venue</button> 
                                       </div>
                                   </div>
                               </div>
                           </form>


                       </div> <!-- end card-body -->
                   </div> <!-- end card-->
               </div> <!-- end col -->



               <div class="col-md-8">
                <<div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                    <th scope="col">Classroom</th>
                                    <th scope="col">Action</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                   include 'connection.php';

                 $sql = "Select * from classroom" ;
                    $ret = pg_query($db, $sql);
                if (!$ret) {
                     echo pg_last_error($db);
                        exit;
                        }
                while ($row = pg_fetch_row($ret)) {
                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                    "?>
                   
                    <td><a href="deleteclass.php?d_id=<?php echo $row[0]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

               <?php }
   
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
