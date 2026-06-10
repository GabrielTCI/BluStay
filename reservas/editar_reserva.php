<?php
require_once "../conexao.php";

if (!isset($_GET['id_reserva']) || !is_numeric($_GET['id_reserva'])) {
    header('Location: reservas.php');
    exit;
}

$id_reserva = (int) $_GET['id_reserva'];

$sql = "SELECT * FROM reservas WHERE id_reserva = :id_reserva LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
$stmt->execute();
$reserva = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reserva) {
    header("Location: ../reservas.php");
    exit;
}

$clientes = $conexao->query("SELECT id_cliente, nome FROM clientes ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
$quartos = $conexao->query("SELECT id_quarto, numero, tipo_quarto, status FROM quartos ORDER BY numero ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Reserva</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="card">
<h1># Editar Reserva</h1>

<form action="atualizar_reserva.php" method="POST">
<input type="hidden" name="id_reserva" value="<?= htmlspecialchars($reserva['id_reserva']) ?>">

<label>Hóspede:</label>
<select name="id_cliente" required>
<?php foreach ($clientes as $cliente): ?>
<option value="<?= htmlspecialchars($cliente['id_cliente']) ?>" <?= $reserva['id_cliente'] == $cliente['id_cliente'] ? 'selected' : '' ?>>
<?= htmlspecialchars($cliente['nome']) ?>
</option>
<?php endforeach; ?>
</select>

<label>Quarto:</label>
<select name="id_quarto" required>
<?php foreach ($quartos as $quarto): ?>
<option value="<?= htmlspecialchars($quarto['id_quarto']) ?>" <?= $reserva['id_quarto'] == $quarto['id_quarto'] ? 'selected' : '' ?>>
<?= htmlspecialchars($quarto['numero']) ?> - <?= htmlspecialchars($quarto['tipo_quarto']) ?> (<?= htmlspecialchars($quarto['status']) ?>)
</option>
<?php endforeach; ?>
</select>

<label>Data de entrada:</label>
<input type="date" name="data_entrada" required value="<?= htmlspecialchars($reserva['data_entrada']) ?>">

<label>Data de saída:</label>
<input type="date" name="data_saida" required value="<?= htmlspecialchars($reserva['data_saida']) ?>">

<label>Status:</label>
<select name="status" required>
<option value="Ativa" <?= $reserva['status'] === 'Ativa' ? 'selected' : '' ?>>Ativa</option>
<option value="Finalizada" <?= $reserva['status'] === 'Finalizada' ? 'selected' : '' ?>>Finalizada</option>
<option value="Cancelada" <?= $reserva['status'] === 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
</select>

<button type="submit" class="btn-save">Salvar Alterações</button>
</form>

<a href="../reservas.php" class="link-list">Voltar para a lista</a>
</div>
</body>
</html>
