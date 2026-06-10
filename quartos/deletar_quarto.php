<?php
require_once "../conexao.php";

if (!isset($_GET['id_quarto']) || !is_numeric($_GET['id_quarto'])) {
    header('Location: quartos.php'); exit;
}

$id_quarto = (int) $_GET['id_quarto'];

// == 2. VERIFICACAO PREVIA — CONFIRMA QUE O QUARTO EXISTE
$check = $conexao->prepare(
    "SELECT id_quarto FROM quartos WHERE id_quarto = :id_quarto LIMIT 1"
);
$check->bindParam(':id_quarto', $id_quarto, PDO::PARAM_INT);
$check->execute();

if (!$check->fetch()) {
    header('Location: quartos.php'); exit;
}

// == 3. DELETE — REMOVE O REGISTRO DO BANCO ==========
$sql = "DELETE FROM quartos WHERE id_quarto = :id_quarto";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id_quarto", $id_quarto, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: ../quartos.php?msg=deletado"); exit;
} catch (PDOException $erro) {
    die("Erro ao deletar quarto: " . $erro->getMessage());
}
?>
