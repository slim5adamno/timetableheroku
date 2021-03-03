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
                                <li class="breadcrumb-item active">Add/Modify Classroom</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add/Modify Classroom</h4>
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
                                        <input type="number" class="form-control" id="classroomname" name="CN" placeholder="Classroom's Name ..." required>
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
                                            <label>Year</label>
                                            <select class="form-control" id="year" name="YEAR" required>
                                                <option selected disabled>Select</option>
                                                <option value="FY">FY</option>
                                                <option value="SY">SY</option>
                                                <option value="TY">TY</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" id="semester" name="SEM" required>
                                                <option selected disabled>Select</option>
                                                <option value="SEM I">SEM I</option>
                                                <option value="SEM II">SEM II</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <select class="form-control" id="Time" name="TIME" required>
                                                <option selected disabled>Select</option>
                                                <option value="MORNING">MORNING</option>
                                                <option value="AFTERNOON">AFTERNOON</option>
                                            </select>
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
                            <table id="basic-datatable" data-page-length="50" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                    <th scope="col">Classroom Name</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Action</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                   include 'connection.php';

                 $sql = "Select * from classroom_allot" ;
                    $ret = pg_query($db, $sql);
                if (!$ret) {
                     echo pg_last_error($db);
                        exit;
                        }

                while ($row = pg_fetch_row($ret)) {

                    $sql2="select name from department where did=$row[1]";
                    $return2=pg_query($db,$sql2);
                    if(!$return2) {
                        echo pg_last_error($db);
                    } else {
                        $id2 =pg_fetch_row($return2);

                    }
                    echo "<tr><th scope=\"row\">{$row[0]}</th>
                        <td>  {$row[2]}</td>
                        <td>  {$row[3]}</td>  
                        <td>  {$id2[0]}</td>
                        <td> {$row[4]}</td>
              

                    "?>
                   
                    <td><a href="deleteclass.php?d_id=<?php echo $row[0]?>&time=<?php echo $row[4]?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a></td>

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
