<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: reservas.php");
    exit;
}

$id_reserva = (int) ($_POST["id_reserva"] ?? 0);
$id_cliente = (int) ($_POST["id_cliente"] ?? 0);
$id_quarto = (int) ($_POST["id_quarto"] ?? 0);
$data_entrada = trim($_POST["data_entrada"] ?? "");
$data_saida = trim($_POST["data_saida"] ?? "");
$status = trim($_POST["status"] ?? "");

if ($id_reserva <= 0 || $id_cliente <= 0 || $id_quarto <= 0 || empty($data_entrada) || empty($data_saida) || empty($status)) {
    die("Erro: Dados inválidos ou incompletos.");
}

$sql = "UPDATE reservas
        SET id_cliente = :id_cliente,
            id_quarto = :id_quarto,
            data_entrada = :data_entrada,
            data_saida = :data_saida,
            status = :status
        WHERE id_reserva = :id_reserva";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
$stmt->bindParam(":id_quarto", $id_quarto, PDO::PARAM_INT);
$stmt->bindParam(":data_entrada", $data_entrada);
$stmt->bindParam(":data_saida", $data_saida);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":id_reserva", $id_reserva, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: ../reservas.php?msg=editado");
    exit;
} catch (PDOException $erro) {
    die("Erro ao atualizar reserva: " . $erro->getMessage());
}
?>
