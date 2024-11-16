<?php
if($_SESSION['idSessao'] !== 2){
    header('Location: ../error.html');
}