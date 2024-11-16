<?php
if($_SESSION['idSessao'] !== 4){
    header('Location: ../error.html');
}