<?php

include 'connection.php';
if (isset($_POST['TF']) && isset($_POST['TN']) && isset($_POST['TD'])  && isset($_POST['TP']) && isset($_POST['TE'])) {
    $name =strtoupper($_POST['TN']);
    $facno = $_POST['TF'];
    $designation =strtoupper($_POST['TD']);
    $contact = $_POST['TP'];
    $email = strtoupper($_POST['TE']);
} else {

    die("not set");
}




$sql="update teacher set name='$name',designation='$designation',email='$email',contact='$contact'";


$ret = pg_query($db, $sql);
if(!$ret) {
    echo pg_last_error($db);
} else {


    header("Location:view-lecturer.php");


}


pg_close($db);

?>