<?php

function debu($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo( string $actual, string $proximo): bool {
    if($actual !== $proximo) {
        return true;
    } 
        return false;
}

//funcion que revisa que el usuario este autentificado
function esAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function esAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}