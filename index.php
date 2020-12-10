<?php
require "routes/url.php";
error_reporting(-1);

setlocale(LC_ALL, 'pt_BR');
date_default_timezone_set('America/Sao_Paulo');

session_start();

$pag = $modulo = Url::getURL(0) ?? 'inicio';
$_SESSION['logado'] = $_SESSION['logado'] ?? null;
$_SESSION['cod_usuario'] = $_SESSION['cod_usuario'] ?? null;

if (strcasecmp($pag, 'api') != 0) {
    include('view/components/cabecalho.php');
    include('view/components/menu.php');
    $pag = str_replace('-', '', $pag);
    if (file_exists("view/$pag.php")) {
        include('view/' . $pag . '.php');
    } else {
        include('view/404.php');
    }

    include('view/components/rodape.php');
}else{
    if (file_exists("api/$pag.php")) {
        include('api/' . $pag . '.php');
    } else {
        include('api/404.php');
    }
}
