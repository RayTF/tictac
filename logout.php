<?php
include("config.php");
 session_start();
 unset($_SESSION['']);

 if(session_destroy())
 {
  header("Location: .");
 }
?>