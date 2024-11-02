<?php
session_start();
ob_start();

?>

<div class="card" style="min-height: 600px; max-height:600px; position: relative; overflow:auto;">
    <div class="card left alert alert-info"  style="margin-right: auto;">
asd    
</div>
    <br>
    <div class="card left alert alert-warning"  style="margin-left: auto;">
asdads    
</div>
    <br>
    
    
   
</div>
<br>
 <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Mensagem" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Enviar</button>
    </div>

<?php
$content = ob_get_clean(); 
$pageTitle = "Dados pessoais"; 
include('../app/public/html/template.php'); 
?>
