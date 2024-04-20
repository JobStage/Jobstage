<?php
require_once 'FormacaoController.php';
$formacao = new FormacaoController();

// Verifica se foi feita uma requisição POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o arquivo foi enviado sem erros
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Recupera os dados do formulário
        $curso = $_POST["curso"];
        $setor = $_POST["setor"];
        $instituicao = $_POST["instituicao"];
        $nivel = $_POST["nivel"];
        $inicio = $_POST["inicio"];
        $fim = $_POST["fim"];
        $status = $_POST["status"];
        $arquivo = $_FILES['file'];

        if($arquivo['type'] == 'application/pdf'){
            $renomear = md5(time()) . '.pdf';
            $caminho_upload = "../matricula/";

            $formacao->criarFormacao($curso, $setor, $instituicao, $nivel, $inicio, $fim, $status, $renomear);


            
            if(move_uploaded_file($arquivo['tmp_name'], $caminho_upload . $renomear)){
               $retorno = array('tittle' => 'Sucesso', 'msg' => 'Formação cadastrada com sucesso!', 'icon' => 'success');
               echo json_encode($retorno);
                return;
            }else{
                $retorno = array('tittle' => 'erro', 'msg' => 'erro', 'icon' => 'danger');
                echo json_encode($retorno);
                return;
            }
        }else{
            $retorno = array('tittle' => 'erro', 'msg' => 'Insira apenas arquivo PDF!', 'icon' => 'warning');

            echo json_encode($retorno);
            return;
        }
    } else {
        // Se ocorreu algum erro no envio do arquivo, imprime a mensagem de erro
        echo "Erro no envio do arquivo.";
    }
} else {
    // Se não foi feita uma requisição POST, imprime uma mensagem de erro
    echo "Esta página só pode ser acessada via POST.";
}
?>
