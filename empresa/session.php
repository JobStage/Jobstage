<?php

if($_SESSION['idSessao'] != 2){
    echo '<div class="alert alert-danger" role="alert">
            Você não tem acesso a essa pagina!
        </div>';
}
?>