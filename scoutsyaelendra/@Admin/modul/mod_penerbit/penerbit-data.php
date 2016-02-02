<?php
$q= $_GET['q'];
$my_data=mysql_real_escape_string($q);

 $mysqli=mysqli_connect('localhost','root','','dbgloria') or die("Database Error");
 $sql= "SELECT nama FROM author WHERE nama LIKE '%$my_data%' ORDER BY nama";
 $result = mysqli_query($mysqli,$sql) or die(mysqli_error());

 if($result)
 {
  while($row=mysqli_fetch_array($result))
  {
   echo $row['nama']."\n";
  }
 }
?>