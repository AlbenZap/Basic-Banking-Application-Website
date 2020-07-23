<?php 
session_start();
session_destroy(); //empty the session array
header('Location:../login/');

 ?>