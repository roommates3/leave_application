<?php
   $host        = "host = 127.0.0.1";
   $port        = "port = 5432";
   $dbname      = "dbname = leave";
   $credentials = "user = dbuser password=dbuserpro";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
    //   echo "Opened database successfully\n";
   }
?>