<?php
require_once "conexao.php";

// == SELECT — BUSCA TODOS OS PAGAMENTOS ===========
$sql = "SELECT p.id_pagamentos, p.id_reserva, p.valor, p.forma_pagamento, p.status_pagamento,
               c.nome AS nome_cliente,
               q.numero AS numero_quarto
        FROM pagamentos p
        INNER JOIN reservas r ON p.id_reserva = r.id_reserva
        INNER JOIN clientes c ON r.id_cliente = c.id_cliente
        INNER JOIN quartos q ON r.id_quarto = q.id_quarto
        ORDER BY p.id_pagamentos DESC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$pagamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($pagamentos);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Pagamentos</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
<h1>Pagamentos (<?= $total ?>)</h1>

<?php if (isset($_GET['msg'])): ?>
<?php if ($_GET['msg'] === 'sucesso'): ?>
<p class="msg-ok">Pagamento cadastrado com sucesso!</p>
<?php elseif ($_GET['msg'] === 'editado'): ?>
<p class="msg-ok">Pagamento atualizado com sucesso!</p>
<?php elseif ($_GET['msg'] === 'deletado'): ?>
<p class="msg-del">Pagamento removido.</p>
<?php endif; endif; ?>

<a href="pagamentos/index_pagamento.php" class="botao_cadastro">+ Novo Pagamento</a>
<a href="reservas.php" class="botao_reservas">Ver Reservas</a>
<br>
<a href="index.php" class="botao_reservas">Voltar ao cadastro de hóspedes</a>

<table>
<thead>
<tr>
<th>ID</th><th>Reserva</th><th>Cliente</th><th>Quarto</th><th>Valor</th><th>Forma</th><th>Status</th><th>Ações</th>
</tr>
</thead>
<tbody>
<?php foreach ($pagamentos as $pagamento): ?>
<tr>
<td><?= htmlspecialchars($pagamento['id_pagamentos']) ?></td>
<td><?= htmlspecialchars($pagamento['id_reserva']) ?></td>
<td><?= htmlspecialchars($pagamento['nome_cliente']) ?></td>
<td><?= htmlspecialchars($pagamento['numero_quarto']) ?></td>
<td>R$ <?= htmlspecialchars($pagamento['valor']) ?></td>
<td><?= htmlspecialchars($pagamento['forma_pagamento']) ?></td>
<td><?= htmlspecialchars($pagamento['status_pagamento']) ?></td>
<td>
<a href="pagamentos/editar_pagamento.php?id_pagamentos=<?= $pagamento['id_pagamentos'] ?>" class="btn-edit">Editar</a>
<a href="pagamentos/deletar_pagamento.php?id_pagamentos=<?= $pagamento['id_pagamentos'] ?>" class="btn-del" onclick="return confirm('Excluir este pagamento?')">
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($total === 0): ?>
<p style="color:#888;text-align:center;margin-top:20px">Nenhum pagamento cadastrado ainda.</p>
<?php endif; ?>
</div>
</body>
</html>
