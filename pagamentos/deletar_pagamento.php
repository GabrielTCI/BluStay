<?php
require_once "../conexao.php";

if (!isset($_GET['id_pagamentos']) || !is_numeric($_GET['id_pagamentos'])) {
    header('Location: pagamentos.php');
    exit;
}

$id_pagamentos = (int) $_GET['id_pagamentos'];

$check = $conexao->prepare("SELECT id_pagamentos FROM pagamentos WHERE id_pagamentos = :id_pagamentos LIMIT 1");
$check->bindParam(':id_pagamentos', $id_pagamentos, PDO::PARAM_INT);
$check->execute();

if (!$check->fetch()) {
    header('Location: pagamentos.php');
    exit;
}

$sql = "DELETE FROM pagamentos WHERE id_pagamentos = :id_pagamentos";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_pagamentos', $id_pagamentos, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: ../pagamentos.php?msg=deletado");
    exit;
} catch (PDOException $erro) {
    die("Erro ao deletar pagamento: " . $erro->getMessage());
}
?>
