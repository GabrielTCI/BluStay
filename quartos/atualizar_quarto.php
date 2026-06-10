<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: quartos.php");
    exit;
}

$id_quarto = (int) ($_POST["id_quarto"] ?? 0);
$numero = trim($_POST["numero"] ?? "");
$tipo_quarto = trim($_POST["tipo_quarto"] ?? "");
$preco_diaria = trim($_POST["preco_diaria"] ?? "");
$status = trim($_POST["status"] ?? "");

if ($id_quarto <= 0 || empty($numero) || empty($tipo_quarto) || empty($preco_diaria) || empty($status)) {
    die("Erro: Dados inválidos ou incompletos.");
}

$sql = "UPDATE quartos
        SET numero = :numero,
            tipo_quarto = :tipo_quarto,
            preco_diaria = :preco_diaria,
            status = :status
        WHERE id_quarto = :id_quarto";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(":numero", $numero);
$stmt->bindParam(":tipo_quarto", $tipo_quarto);
$stmt->bindParam(":preco_diaria", $preco_diaria);
$stmt->bindParam(":status", $status);
$stmt->bindParam(":id_quarto", $id_quarto, PDO::PARAM_INT);

try {
    $stmt->execute();
    header("Location: ../quartos.php?msg=editado");
    exit;
} catch (PDOException $erro) {
    die("Erro ao atualizar quarto: " . $erro->getMessage());
}
?>