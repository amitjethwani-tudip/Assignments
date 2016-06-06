<?php
include 'db.php';
if(isset($_POST['btn-save']))
{

 $name = $_POST['FullName'];
 $number = $_POST['number'];
 $in = $_POST['in'];
 $out = $_POST['out'];
 
 

 
        $sql_query = "INSERT INTO guestbook1(FullName,Mobile Number,In Time,Out Time) VALUES('$FullName','$number','$in','$out')";
 mysql_query($sql_query);
        
        
 
}
?>