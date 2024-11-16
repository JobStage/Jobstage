<?php
if($_SESSION['idSessao'] !== 1){
    header('Location: ../error.html');
}