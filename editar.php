<?php
require_once "conexao.php";
if (!isset($_GET['id_cliente']) || !is_numeric($_GET['id_cliente'])) {
header('Location: listar.php'); exit;
}
$id_cliente = (int) $_GET['id_cliente']; // Cast seguro para inteiro
// == SELECT — Busca o cliente PELO ID ===========
$sql = "SELECT * FROM clientes WHERE id_cliente = :id_cliente LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$cliente) { header('Location: listar.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8"><title>Editar Hospede</title>
<link rel="stylesheet" href="style.css">
</head>
<body><div class="card">
<h1># Editar Hospede</h1>
<form action="atualizar.php" method="POST">
<!-- Campo oculto transporta o id para atualizar.php -->
<input type="hidden" name="id_cliente"
value="<?= htmlspecialchars($cliente['id_cliente']) ?>">
<label>Nome:</label>
<input type="text" name="nome" required
value="<?= htmlspecialchars($cliente['nome']) ?>">
<label>E-mail:</label>
<input type="email" name="email" required
value="<?= htmlspecialchars($cliente['email']) ?>">
<label>CPF:</label>
<input type="text" name="cpf" required
value="<?= htmlspecialchars($cliente['cpf']) ?>">
<button type="submit" class="btn-save">Salvar Alterações</button>
</form>
<a href="listar.php" class="link-list">Voltar para a lista</a>
</div></body></html>
