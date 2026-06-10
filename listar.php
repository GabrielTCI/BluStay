<?php
require_once "conexao.php";

$sql = "SELECT * FROM clientes ORDER BY nome ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($clientes);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Lista de Hóspedes</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h1>Hóspedes Cadastrados (<?= $total ?>)</h1>

<?php if (isset($_GET['msg'])): ?>
<?php if ($_GET['msg'] === 'sucesso'): ?>
<p class="msg-ok">Hóspede cadastrado com sucesso!</p>
<?php elseif ($_GET['msg'] === 'editado'): ?>
<p class="msg-ok">Hóspede atualizado com sucesso!</p>
<?php elseif ($_GET['msg'] === 'deletado'): ?>
<p class="msg-del">Hóspede removido.</p>
<?php endif; ?>
<?php endif; ?>

<a href="index.php" class="botao_cadastro">+ Novo Hóspede</a>

<table>
<thead>
<tr>
<th>ID</th>
<th>Nome</th>
<th>E-mail</th>
<th>CPF</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
<?php foreach ($clientes as $cliente): ?>
<tr>
<td><?= htmlspecialchars($cliente['id_cliente']) ?></td>
<td><?= htmlspecialchars($cliente['nome']) ?></td>
<td><?= htmlspecialchars($cliente['email']) ?></td>
<td><?= htmlspecialchars($cliente['cpf']) ?></td>
<td>
<a href="clientes/editar.php?id_cliente=<?= $cliente['id_cliente'] ?>" class="btn-edit">Editar</a>

<a href="clientes/deletar.php?id_cliente=<?= $cliente['id_cliente'] ?>" class="btn-del" onclick="return confirm('Excluir este hóspede?')">Excluir</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($total === 0): ?>
<p style="color:#888;text-align:center;margin-top:20px">Nenhum hóspede cadastrado ainda.</p>
<?php endif; ?>

<br>
<a href="index.php" class="link-list">Voltar ao início</a>
<br>
<a href="quartos.php" class="link-list">Ver quartos</a>
<br>
<a href="reservas.php" class="link-list">Ver reservas</a>
<br>
<a href="pagamentos.php" class="link-list">Ver pagamentos</a>

</div>

</body>
</html>