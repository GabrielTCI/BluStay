<?php
require_once "../conexao.php";

if (!isset($_GET['id_reserva']) || !is_numeric($_GET['id_reserva'])) {
    header('Location: reservas.php');
    exit;
}

$id_reserva = (int) $_GET['id_reserva'];

$check = $conexao->prepare("SELECT id_reserva FROM reservas WHERE id_reserva = :id_reserva LIMIT 1");
$check->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
$check->execute();

if (!$check->fetch()) {
    header('Location: reservas.php');
    exit;
}

$sql = "DELETE FROM reservas WHERE id_reserva = :id_reserva";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: ../reservas.php?msg=deletado");
    exit;
} catch (PDOException $erro) {
    die("Erro ao deletar reserva: " . $erro->getMessage());
}
?>
