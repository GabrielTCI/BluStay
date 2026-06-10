<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: pagamentos.php");
    exit;
}

$id_pagamentos = (int) ($_POST["id_pagamentos"] ?? 0);
$id_reserva = (int) ($_POST["id_reserva"] ?? 0);
$valor = trim($_POST["valor"] ?? "");
$forma_pagamento = trim($_POST["forma_pagamento"] ?? "");
$status_pagamento = trim($_POST["status_pagamento"] ?? "");

if ($id_pagamentos <= 0 || $id_reserva <= 0 || empty($valor) || empty($forma_pagamento) || empty($status_pagamento)) {
    die("Erro: Dados inválidos ou incompletos.");
}

$sql = "UPDATE pagamentos
        SET id_reserva = :id_reserva,
            valor = :valor,
            forma_pagamento = :forma_pagamento,
            status_pagamento = :status_pagamento
        WHERE id_pagamentos = :id_pagamentos";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id_reserva", $id_reserva, PDO::PARAM_INT);
$stmt->bindParam(":valor", $valor);
$stmt->bindParam(":forma_pagamento", $forma_pagamento);
$stmt->bindParam(":status_pagamento", $status_pagamento);
$stmt->bindParam(":id_pagamentos", $id_pagamentos, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: ../pagamentos.php?msg=editado");
    exit;
} catch (PDOException $erro) {
    die("Erro ao atualizar pagamento: " . $erro->getMessage());
}
?>
