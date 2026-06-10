<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index_pagamento.php");
    exit;
}

$id_reserva = (int) ($_POST["id_reserva"] ?? 0);
$valor = trim($_POST["valor"] ?? "");
$forma_pagamento = trim($_POST["forma_pagamento"] ?? "");
$status_pagamento = trim($_POST["status_pagamento"] ?? "");

if ($id_reserva <= 0 || empty($valor) || empty($forma_pagamento) || empty($status_pagamento)) {
    die("Erro: Dados inválidos ou incompletos.");
}

$sql = "INSERT INTO pagamentos (id_reserva, valor, forma_pagamento, status_pagamento)
        VALUES (:id_reserva, :valor, :forma_pagamento, :status_pagamento)";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id_reserva", $id_reserva, PDO::PARAM_INT);
$stmt->bindParam(":valor", $valor);
$stmt->bindParam(":forma_pagamento", $forma_pagamento);
$stmt->bindParam(":status_pagamento", $status_pagamento);

try {
    $stmt->execute();
    header("Location: ../pagamentos.php?msg=sucesso");
    exit;
} catch (PDOException $erro) {
    die("Erro ao cadastrar pagamento: " . $erro->getMessage());
}
?>
