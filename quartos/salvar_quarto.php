<?php
require_once "../conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index_quarto.php");
    exit;
}

$numero = trim($_POST["numero"] ?? "");
$tipo_quarto = trim($_POST["tipo_quarto"] ?? "");
$preco_diaria = trim($_POST["preco_diaria"] ?? "");
$status = trim($_POST["status"] ?? "");

if (empty($numero) || empty($tipo_quarto) || empty($preco_diaria) || empty($status)) {
    header("Location: index_quarto.php?erro=Campos+obrigatorios");
    exit;
}

$sql = "INSERT INTO quartos (numero, tipo_quarto, preco_diaria, status)
        VALUES (:numero, :tipo_quarto, :preco_diaria, :status)";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(":numero", $numero);
$stmt->bindParam(":tipo_quarto", $tipo_quarto);
$stmt->bindParam(":preco_diaria", $preco_diaria);
$stmt->bindParam(":status", $status);

try {
    $stmt->execute();
    header("Location: ../quartos.php?msg=sucesso");
    exit;
} catch (PDOException $erro) {
    die("Erro ao cadastrar quarto: " . $erro->getMessage());
}
?>