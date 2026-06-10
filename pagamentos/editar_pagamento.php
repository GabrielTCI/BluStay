<?php
require_once "../conexao.php";

if (!isset($_GET['id_pagamentos']) || !is_numeric($_GET['id_pagamentos'])) {
    header('Location: pagamentos.php');
    exit;
}

$id_pagamentos = (int) $_GET['id_pagamentos'];

$sql = "SELECT * FROM pagamentos WHERE id_pagamentos = :id_pagamentos LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_pagamentos', $id_pagamentos, PDO::PARAM_INT);
$stmt->execute();
$pagamento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pagamento) {
    header("Location: ../pagamentos.php");
    exit;
}

$sqlReservas = "SELECT r.id_reserva, c.nome AS nome_cliente, q.numero AS numero_quarto
                FROM reservas r
                INNER JOIN clientes c ON r.id_cliente = c.id_cliente
                INNER JOIN quartos q ON r.id_quarto = q.id_quarto
                ORDER BY r.id_reserva DESC";
$reservas = $conexao->query($sqlReservas)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Editar Pagamento</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="card">
<h1># Editar Pagamento</h1>

<form action="atualizar_pagamento.php" method="POST">
<input type="hidden" name="id_pagamentos" value="<?= htmlspecialchars($pagamento['id_pagamentos']) ?>">

<label>Reserva:</label>
<select name="id_reserva" required>
<?php foreach ($reservas as $reserva): ?>
<option value="<?= htmlspecialchars($reserva['id_reserva']) ?>" <?= $pagamento['id_reserva'] == $reserva['id_reserva'] ? 'selected' : '' ?>>
Reserva #<?= htmlspecialchars($reserva['id_reserva']) ?> - <?= htmlspecialchars($reserva['nome_cliente']) ?> - Quarto <?= htmlspecialchars($reserva['numero_quarto']) ?>
</option>
<?php endforeach; ?>
</select>

<label>Valor:</label>
<input type="number" name="valor" min="0" step="0.01" required value="<?= htmlspecialchars($pagamento['valor']) ?>">

<label>Forma de pagamento:</label>
<select name="forma_pagamento" required>
<option value="Dinheiro" <?= $pagamento['forma_pagamento'] === 'Dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
<option value="Cartão de Crédito" <?= $pagamento['forma_pagamento'] === 'Cartão de Crédito' ? 'selected' : '' ?>>Cartão de Crédito</option>
<option value="Cartão de Débito" <?= $pagamento['forma_pagamento'] === 'Cartão de Débito' ? 'selected' : '' ?>>Cartão de Débito</option>
<option value="Pix" <?= $pagamento['forma_pagamento'] === 'Pix' ? 'selected' : '' ?>>Pix</option>
</select>

<label>Status do pagamento:</label>
<select name="status_pagamento" required>
<option value="Pendente" <?= $pagamento['status_pagamento'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
<option value="Pago" <?= $pagamento['status_pagamento'] === 'Pago' ? 'selected' : '' ?>>Pago</option>
<option value="Cancelado" <?= $pagamento['status_pagamento'] === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
</select>

<button type="submit" class="btn-save">Salvar Alterações</button>
</form>

<a href="../pagamentos.php" class="link-list">Voltar para a lista</a>
</div>
</body>
</html>
