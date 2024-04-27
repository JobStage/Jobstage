<?php
 /*
------------------------------------------------------------------------------------------------------
                                                                                                     |
  ALTERA APENAS OS ARQUIVOS CADASTRADOS NO SISTEMA NO DIRETÓRIO ../MATRICULA E NÃO NO BANCO DE DADOS |
                                                                                                     |
------------------------------------------------------------------------------------------------------
*/
class matricula {
    public function inserirMatricula($arquivo): string | false{
        // verifica se o arquivo enviado é diferente de PDF
        if($arquivo['type'] != 'application/pdf'){
            $retorno = array('tittle' => 'erro', 'msg' => 'Arquivo não suportado', 'icon' => 'error');
            echo json_encode($retorno);
            return $retorno;
        }


        $nomeArquivoRenomeado = md5(time()) . '.pdf';
        $caminho_upload = "../matricula/";
        

        if(move_uploaded_file($arquivo['tmp_name'], $caminho_upload . $nomeArquivoRenomeado)){
            return $nomeArquivoRenomeado;
        }else{
            return false;
        }
    }


    public function atualizarMatricula($nomeMatricula, $arquivo): string | false{
        if($arquivo['type'] != 'application/pdf'){
            
            $retorno = array('tittle' => 'erro', 'msg' => 'Arquivo não suportado', 'icon' => 'error');
            echo json_encode($retorno);
            return $retorno;
        }


        if($nomeMatricula){
            // deleta arquivo cadastrado no sistema
            $caminho_detele = '../matricula/' . $nomeMatricula;

            unlink($caminho_detele);
            $nomeArquivoRenomeado = md5(time()) . '.pdf';
            $caminho_upload = "../matricula/" . $nomeArquivoRenomeado;

            if(move_uploaded_file($arquivo['tmp_name'], $caminho_upload)){
                return $nomeArquivoRenomeado;
            }else{
                return false;
            }
        }
    }

    
    public function excluirMatricula($nomeMatricula): bool{
        if($nomeMatricula){
            $caminho = '../matricula/' . $nomeMatricula;
            unlink($caminho);
            return true;
        }
        
        return false;
    }
}