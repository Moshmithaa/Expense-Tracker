<?php 

$conn = mysqli_connect('localhost','moshmithaa','Got7jb@123','expense');
   
   if(!$conn){
       echo 'Connection Error ' . mysqli_connect_error();
       exit();
   }

?>