<?php
require_once "../conexao.php";

$clientes = $conexao->query("SELECT id_cliente, nome FROM clientes ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);
$quartos = $conexao->query("SELECT id_quarto, numero, tipo_quarto, status FROM quartos ORDER BY numero ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastrar Reserva</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<h1 class="titulo">BluStay</h1>
<div class="card">
<h2>Cadastrar Reserva</h2>
<p class="legenda">Cadastre uma reserva para um hóspede.</p>

<form action="salvar_reserva.php" method="POST">
<label>Hóspede</label>
<select name="id_cliente" required>
<option value="">Selecione um hóspede</option>
<?php foreach ($clientes as $cliente): ?>
<option value="<?= htmlspecialchars($cliente['id_cliente']) ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
<?php endforeach; ?>
</select>

<label>Quarto</label>
<select name="id_quarto" required>
<option value="">Selecione um quarto</option>
<?php foreach ($quartos as $quarto): ?>
<option value="<?= htmlspecialchars($quarto['id_quarto']) ?>">
<?= htmlspecialchars($quarto['numero']) ?> - <?= htmlspecialchars($quarto['tipo_quarto']) ?> (<?= htmlspecialchars($quarto['status']) ?>)
</option>
<?php endforeach; ?>
</select>

<label>Data de entrada</label>
<input type="date" name="data_entrada" required>

<label>Data de saída</label>
<input type="date" name="data_saida" required>

<label>Status</label>
<select name="status" required>
<option value="Ativa">Ativa</option>
<option value="Finalizada">Finalizada</option>
<option value="Cancelada">Cancelada</option>
</select>

<button type="submit" class="botao_cadastro">Cadastrar</button>
</form>

<div class="divider"><span></span><p>ou</p><span></span></div>
<a href="../reservas.php" class="botao_reservas">Ver Reservas</a>
<br>
<a href="index.php" class="botao_reservas">Voltar ao cadastro de hóspedes</a>
</div>
</body>
</html>
