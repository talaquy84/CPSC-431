<?php 
//connect to database
$link = mysqli_connect('localhost', 'admin', 'admin', 'database_name');
if (mysqli_connect_errno()) {
   echo '<p>Error: Could not connect to database.<br/>
   Please try again later.</p>';
   exit;
}
?>