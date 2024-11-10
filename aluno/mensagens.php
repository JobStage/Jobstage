<?php
session_start();
ob_start();
require_once '../app/controller/msgController.php';
$msg = new msgController();

?>


<div class="card" style="max-height: 700px; overflow:auto;">
    <?= $msg->listarConversas($_SESSION['id']) ?>
</div>


<br> 



<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>