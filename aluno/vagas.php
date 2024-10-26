<?php
session_start();
require_once '../app/controller/vagaAluno.php';
$vagas = new VagasController();
ob_start(); 
?>

<div class="row g-3">
    <?= $vagas->listarVagas() ?>
</div>

<div class="modal fade" id="vagaModal" tabindex="-1" role="dialog" aria-labelledby="vagaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vagaModalLabel">Detalhes da Vaga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Conteúdo do modal será preenchido via AJAX -->
        <h5 id="modalNomeVaga"></h5>
        <p id="modalSalario"></p>
        <p id="modalCidade"></p>
        <p id="modalRemoto"></p>
        <p id="modalDescricao"></p>
        <p id="modalRequisitos"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div> 
<!-- <script>
  document.querySelectorAll('.verMais').forEach(button => {
    button.addEventListener('click', function() {
      const descricao = this.closest('.card-body').querySelector('.descricaoVaga');
      descricao.style.display = descricao.style.display === 'none' ? 'block' : 'none';
      this.textContent = descricao.style.display === 'none' ? 'Ver mais' : 'Ver menos';
    });
  });
</script> -->
<script src="../app/public/js/vagaAluno.js"></script>

<?php
$content = ob_get_clean(); 
$pageTitle = "Vagas"; 
include('../app/public/html/template.php'); 
?>