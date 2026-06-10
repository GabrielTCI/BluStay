<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index_reserva.php");
    exit;
}

$id_cliente = (int) ($_POST["id_cliente"] ?? 0);
$id_quarto = (int) ($_POST["id_quarto"] ?? 0);
$data_entrada = trim($_POST["data_entrada"] ?? "");
$data_saida = trim($_POST["data_saida"] ?? "");
$status = trim($_POST["status"] ?? "");

if ($id_cliente <= 0 || $id_quarto <= 0 || empty($data_entrada) || empty($data_saida) || empty($status)) {
    die("Erro: Dados inválidos ou incompletos.");
}

$sql = "INSERT INTO reservas (id_cliente, id_quarto, data_entrada, data_saida, status)
        VALUES (:id_cliente, :id_quarto, :data_entrada, :data_saida, :status)";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
$stmt->bindParam(":id_quarto", $id_quarto, PDO::PARAM_INT);
$stmt->bindParam(":data_entrada", $data_entrada);
$stmt->bindParam(":data_saida", $data_saida);
$stmt->bindParam(":status", $status);

try {
    $stmt->execute();
    header("Location: ../reservas.php?msg=sucesso");
    exit;
} catch (PDOException $erro) {
    die("Erro ao cadastrar reserva: " . $erro->getMessage());
}
?>
