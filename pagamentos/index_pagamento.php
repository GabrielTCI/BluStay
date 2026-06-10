<?php
require_once "../conexao.php";

$sql = "SELECT r.id_reserva, c.nome AS nome_cliente, q.numero AS numero_quarto
        FROM reservas r
        INNER JOIN clientes c ON r.id_cliente = c.id_cliente
        INNER JOIN quartos q ON r.id_quarto = q.id_quarto
        ORDER BY r.id_reserva DESC";
$reservas = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastrar Pagamento</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<h1 class="titulo">BluStay</h1>
<div class="card">
<h2>Cadastrar Pagamento</h2>
<p class="legenda">Cadastre um pagamento para uma reserva.</p>

<form action="salvar_pagamento.php" method="POST">
<label>Reserva</label>
<select name="id_reserva" required>
<option value="">Selecione uma reserva</option>
<?php foreach ($reservas as $reserva): ?>
<option value="<?= htmlspecialchars($reserva['id_reserva']) ?>">
Reserva #<?= htmlspecialchars($reserva['id_reserva']) ?> - <?= htmlspecialchars($reserva['nome_cliente']) ?> - Quarto <?= htmlspecialchars($reserva['numero_quarto']) ?>
</option>
<?php endforeach; ?>
</select>

<label>Valor</label>
<input type="number" name="valor" min="0" step="0.01" placeholder="Digite o valor" required>

<label>Forma de pagamento</label>
<select name="forma_pagamento" required>
<option value="Dinheiro">Dinheiro</option>
<option value="Cartão de Crédito">Cartão de Crédito</option>
<option value="Cartão de Débito">Cartão de Débito</option>
<option value="Pix">Pix</option>
</select>

<label>Status do pagamento</label>
<select name="status_pagamento" required>
<option value="Pendente">Pendente</option>
<option value="Pago">Pago</option>
<option value="Cancelado">Cancelado</option>
</select>

<button type="submit" class="botao_cadastro">Cadastrar</button>
</form>

<div class="divider"><span></span><p>ou</p><span></span></div>
<a href="pagamentos.php" class="botao_reservas">Ver Pagamentos</a>
<br>
<a href="reservas.php" class="botao_reservas">Ver Reservas</a>
</div>
</body>
</html>
