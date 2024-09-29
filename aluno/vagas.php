<?php
session_start();
require_once '../app/controller/vagaAluno.php';
$vagas = new VagasController();
ob_start(); 
?>
<div class="container">
  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <div class="input-group">
        <input type="search" class="form-control" placeholder="Pesquisar vagas" aria-label="Pesquisar vagas">
        <button class="btn btn-outline-secondary" type="button">Pesquisar</button>
      </div>
    </div>
  </div>
</div>
<!-- <div class="row g-3">
  <div class="col-xl-6">
 
  </div>
</div> -->
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
      <!-- onde o aluno podera colocar de 1 a 5 estrela em relacao as perguntas -->
       <!-- Modal para exibir perguntas -->
      <div class="modal fade" id="modalPerguntas" tabindex="-1" aria-labelledby="modalPerguntasLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalPerguntasLabel">Perguntas da Vaga</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="modalPerguntasBody">
                      <!-- Perguntas serão injetadas aqui via JS -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="btnResponder">Responder e Enviar</button>
                  </div>
              </div>
          </div>
      </div>

      <!-- <div class="rate">
        <input type="radio" id="star5" name="rate" value="5" />
        <label for="star5" title="text">5 stars</label>
        <input type="radio" id="star4" name="rate" value="4" />
        <label for="star4" title="text">4 stars</label>
        <input type="radio" id="star3" name="rate" value="3" />
        <label for="star3" title="text">3 stars</label>
        <input type="radio" id="star2" name="rate" value="2" />
        <label for="star2" title="text">2 stars</label>
        <input type="radio" id="star1" name="rate" value="1" />
        <label for="star1" title="text">1 star</label>
      </div> -->
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
