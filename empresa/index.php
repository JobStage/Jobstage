<?php
session_start();
ob_start();

header('Location: dashboard.php');
?>



<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>
