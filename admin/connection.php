<?php
   $host        = "host = ec2-52-70-135-246.compute-1.amazonaws.com";
   $port        = "port = 5432";
   $dbname      = "dbname = d7r8m2mvtjpn0l";
   $credentials = "user = gngswawgmaejmu password=ef43dbb51f3ea72de9839887cd9f618ba6013cfb75577f80cd5093b52a2803c7";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database<br>";
   } 
?>
