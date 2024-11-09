<?php
session_start();
ob_start();
require_once '../app/controller/msgController.php';
$msg = new msgController();

echo $_SESSION['id'], '--', $_GET['id'];
?>


<div class="card" style="max-height: 700px; overflow:auto;">
    <?= $msg->listarMsg($_GET['id'], $_SESSION['id']) ?>
</div>


<br> 
<div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="Mensagem" aria-describedby="button-addon2" id="txt">
    <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="msgAluno(<?= $_SESSION['id'] . ',' . $_GET['id'] ?>)">Enviar</button>
</div>
<script src="../app/public/js/msgEmpresa.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>