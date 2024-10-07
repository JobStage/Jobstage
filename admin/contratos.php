<?php
session_start();
require_once '../app/controller/contratosController.php';
$contratos = new contratosController();

ob_start();  
?>

<style>
.loader {
  width: 50px;
  padding: 8px;
  aspect-ratio: 1;
  border-radius: 50%;
  background: #25b09b;
  --_m: 
    conic-gradient(#0000 10%,#000),
    linear-gradient(#000 0 0) content-box;
  -webkit-mask: var(--_m);
          mask: var(--_m);
  -webkit-mask-composite: source-out;
          mask-composite: subtract;
  animation: l3 1s infinite linear;
}
@keyframes l3 {to{transform: rotate(1turn)}}
.loading{
  text-align: -webkit-center;
}
</style>

<div class="card">
    <div class="card-body">
        <div style="display: flex; flex-direction:column;">
            <?= $contratos->listarSolicitacoesContrato() ?> 
        </div>
    </div>
</div>

<div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="loading">
          <p>Carregando...</p>
          <div class="loader"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../app/public/js/contratos.js"></script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Contratos"; 
include('../app/public/html/template.php'); 
?>
