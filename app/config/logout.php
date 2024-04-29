<?php
session_start();


if($_SESSION['id']){
  unset( $_SESSION['id']);
  session_destroy();
  header('Location: ../../index.php');  
}