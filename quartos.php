<?php
require_once "conexao.php";

$sql = "SELECT * FROM quartos ORDER BY numero ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$quartos = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($quartos);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Quartos Disponíveis</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
<h1>Quartos (<?= $total ?>)</h1>

<?php if (isset($_GET['msg'])): ?>
<?php if ($_GET['msg'] === 'sucesso'): ?>
<p class="msg-ok">Quarto cadastrado com sucesso!</p>
<?php elseif ($_GET['msg'] === 'editado'): ?>
<p class="msg-ok">Quarto atualizado com sucesso!</p>
<?php elseif ($_GET['msg'] === 'deletado'): ?>
<p class="msg-del">Quarto removido.</p>
<?php endif; ?>
<?php endif; ?>

<a href="quartos/index_quarto.php" class="botao_cadastro">+ Novo Quarto</a>

<table>
<thead>
<tr>
<th>ID</th>
<th>Número</th>
<th>Tipo</th>
<th>Preço Diária</th>
<th>Status</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
<?php foreach ($quartos as $quarto): ?>
<tr>
<td><?= htmlspecialchars($quarto['id_quarto']) ?></td>
<td><?= htmlspecialchars($quarto['numero']) ?></td>
<td><?= htmlspecialchars($quarto['tipo_quarto']) ?></td>
<td><?= htmlspecialchars($quarto['preco_diaria']) ?></td>
<td><?= htmlspecialchars($quarto['status']) ?></td>
<td>
<a href="quartos/editar_quarto.php?id_quarto=<?= $quarto['id_quarto'] ?>" class="btn-edit">Editar</a>
<a href="quartos/deletar_quarto.php?id_quarto=<?= $quarto['id_quarto'] ?>" class="btn-del" onclick="return confirm('Excluir este quarto?')">Excluir</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($total === 0): ?>
<p style="color:#888;text-align:center;margin-top:20px">Nenhum quarto cadastrado ainda.</p>
<?php endif; ?>

<br>
<div class="menu-links">

    <a href="index.php" class="btn-menu">
        Voltar ao início
    </a>

    <a href="listar.php" class="btn-menu">
        Ver hóspedes
    </a>

    <a href="reservas.php" class="btn-menu">
        Ver reservas
    </a>

    <a href="pagamentos.php" class="btn-menu">
        Ver pagamentos
    </a>

</div>
</div>

</body>
</html>