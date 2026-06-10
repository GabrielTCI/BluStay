<?php
require_once "../conexao.php";

if (!isset($_GET['id_quarto']) || !is_numeric($_GET['id_quarto'])) {
    header('Location: quartos.php');
    exit;
}

$id_quarto = (int) $_GET['id_quarto'];

$sql = "SELECT * FROM quartos WHERE id_quarto = :id_quarto LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_quarto', $id_quarto, PDO::PARAM_INT);
$stmt->execute();
$quarto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quarto) {
    header("Location: ../quartos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Quarto</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="card">
<h1># Editar Quarto</h1>

<form action="atualizar_quarto.php" method="POST">

<input type="hidden" name="id_quarto" value="<?= htmlspecialchars($quarto['id_quarto']) ?>">

<label>Número do quarto:</label>
<input type="text" name="numero" required value="<?= htmlspecialchars($quarto['numero']) ?>">

<label>Tipo de quarto:</label>
<input type="text" name="tipo_quarto" required value="<?= htmlspecialchars($quarto['tipo_quarto']) ?>">

<label>Preço da diária:</label>
<input type="number" name="preco_diaria" min="0" step="0.01" required value="<?= htmlspecialchars($quarto['preco_diaria']) ?>">

<label>Status:</label>
<select name="status" required>
<option value="Disponível" <?= $quarto['status'] === 'Disponível' ? 'selected' : '' ?>>Disponível</option>
<option value="Ocupado" <?= $quarto['status'] === 'Ocupado' ? 'selected' : '' ?>>Ocupado</option>
<option value="Manutenção" <?= $quarto['status'] === 'Manutenção' ? 'selected' : '' ?>>Manutenção</option>
</select>

<button type="submit" class="btn-save">Salvar Alterações</button>
</form>

<a href="../quartos.php" class="link-list">Voltar para a lista</a>
</div>
</body>
</html>