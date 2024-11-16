<?php
session_start();
require_once '../app/controller/filialController.php';
$filial = new FilialController();
ob_start(); 
?>
<script src="../app/public/js/qrcode.min.js"></script>

<style>
     /* style para criar um grid */
    .card {
        padding: 10px;
    }

    .conteudo-principal {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        align-items: center;
        text-align: center;
        background-color: #7474776b;
    }

    .icons {
        display: flex;
        justify-content: space-around;
    }
</style>
<div class="card">
    <?= $filial->lisarContratosParaAssinar($_SESSION['id']) ?> 
</div>


<div id="qrcode-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); align-items: center; justify-content: center;">
    <div style="background: #fff; padding: 20px; border-radius: 8px; text-align: center; position: relative; display: flex; flex-direction: column; align-items: center;">
        <span id="close-modal" style="position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px;">&times;</span>
        <h3>Assine o Contrato</h3>
        <!-- O link será gerado dinamicamente -->
        <a id="qrcode-link" href="#" target="_blank" style="display: inline-block; margin: 20px auto; position: relative;">
            <div id="qrcode" style="position: relative;"></div>
            <img id="qrcode-logo" src="../app/public/img/jobstage.png" alt="Logo" 
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80px; height: 80px; border-radius: 8px;">
        </a>
        <p>Escaneie o QR Code ou clique para acessar a página de assinatura</p>
    </div>
</div>



<script>

function assinar(id) {
    const url = 'assinarContrato.php?id=' + id;

    // Atualizar o link
    $('#qrcode-link').attr('href', url);

    // Limpar QRCode antes de gerar um novo
    $('#qrcode').empty();

    // Gerar QRCode
    new QRCode(document.getElementById("qrcode"), {
        text: url,
        width: 300, // largura do QR Code
        height: 300, // altura do QR Code
        colorDark: "#000000", // Cor principal
        colorLight: "#ffffff" // Fundo
    });

    // Mostrar Modal
    $('#qrcode-modal').fadeIn();

    // Fechar Modal
    $('#close-modal').click(function () {
        $('#qrcode-modal').fadeOut();
    });

    // Fechar Modal clicando fora
    $('#qrcode-modal').click(function (e) {
        if (e.target.id === 'qrcode-modal') {
            $(this).fadeOut();
        }
    });
}


       

</script>
<?php
$content = ob_get_clean(); 
$pageTitle = "Filiais"; 
include('../app/public/html/template.php'); 
?>