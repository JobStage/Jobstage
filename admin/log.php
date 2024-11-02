<?php
session_start();
require_once '../app/config/conexao.php';
$log = new Conexao();

ob_start();  
?>


<div class="card">
    <div class="card-body">
        <div style="display: flex; flex-direction:column;">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Erro</th>
                <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>     
                <?= $log->listarLogs();?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script src="../app/public/js/matricula.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Validar Matriculas"; 
include('../app/public/html/template.php'); 
?>
