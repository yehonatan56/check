<?php
    include 'index.php';
  //  include 'p.php';
//    include 'dbService.php';

$d = explode('Physical Address. . . . . . . . .',shell_exec ("ipconfig/all"));  
$d1 = explode(':',$d[1]);  
$d2 = explode(' ',$d1[1]);  
$select = "SELECT * FROM `howmeny`";
$result = mysqli_query($select) or die;