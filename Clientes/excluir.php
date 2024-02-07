<?php
require_once('../global.php');
$conexao = new Conexao;

if (isset($_GET['id'])) {
    // Obtenha o ID do cliente da consulta GET
    $id = $_GET['id'];

    // Excluir o cliente
    $cliente = new Cliente($conexao);
    $cliente->excluirCliente($id);

    // Redirecione para a página de visualização após a exclusão
    header("Location: index.php");
    exit;
}
?>
