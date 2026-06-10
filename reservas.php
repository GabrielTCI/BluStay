<?php
require_once "conexao.php";

// == SELECT — BUSCA TODAS AS RESERVAS ===========
$sql = "SELECT r.id_reserva, r.data_entrada, r.data_saida, r.status,
               c.nome AS nome_cliente,
               q.numero AS numero_quarto,
               q.tipo_quarto
        FROM reservas r
        INNER JOIN clientes c ON r.id_cliente = c.id_cliente
        INNER JOIN quartos q ON r.id_quarto = q.id_quarto
        ORDER BY r.data_entrada DESC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($reservas);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Reservas</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
<h1>Reservas (<?= $total ?>)</h1>

<?php if (isset($_GET['msg'])): ?>
<?php if ($_GET['msg'] === 'sucesso'): ?>
<p class="msg-ok">Reserva cadastrada com sucesso!</p>
<?php elseif ($_GET['msg'] === 'editado'): ?>
<p class="msg-ok">Reserva atualizada com sucesso!</p>
<?php elseif ($_GET['msg'] === 'deletado'): ?>
<p class="msg-del">Reserva removida.</p>
<?php endif; endif; ?>

<a href="reservas/index_reserva.php" class="botao_cadastro">+ Nova Reserva</a>
<a href="index.php" class="botao_reservas">Voltar ao cadastro de hóspedes</a>
<br>
<a href="quartos.php" class="botao_reservas">Ver Quartos</a>
<br>
<a href="pagamentos.php" class="botao_reservas">Ver Pagamentos</a>

<table>
<thead>
<tr>
<th>ID</th><th>Cliente</th><th>Quarto</th><th>Entrada</th><th>Saída</th><th>Status</th><th>Ações</th>
</tr>
</thead>
<tbody>
<?php foreach ($reservas as $reserva): ?>
<tr>
<td><?= htmlspecialchars($reserva['id_reserva']) ?></td>
<td><?= htmlspecialchars($reserva['nome_cliente']) ?></td>
<td><?= htmlspecialchars($reserva['numero_quarto']) ?> - <?= htmlspecialchars($reserva['tipo_quarto']) ?></td>
<td><?= htmlspecialchars($reserva['data_entrada']) ?></td>
<td><?= htmlspecialchars($reserva['data_saida']) ?></td>
<td><?= htmlspecialchars($reserva['status']) ?></td>
<td>
<a href="reservas/editar_reserva.php?id_reserva=<?= $reserva['id_reserva'] ?>" class="btn-edit">Editar</a>
<a href="reservas/deletar_reserva.php?id_reserva=<?= $reserva['id_reserva'] ?>" class="btn-del" onclick="return confirm('Excluir esta reserva?')">
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($total === 0): ?>
<p style="color:#888;text-align:center;margin-top:20px">Nenhuma reserva cadastrada ainda.</p>
<?php endif; ?>
</div>
</body>
</html>
