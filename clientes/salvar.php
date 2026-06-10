<?php
// == 1. INCLUI A CONEXAO PDO ==================
require_once "../conexao.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
header("Location: ../index.php"); exit;
}
// == 2. CAPTURA DOS DADOS DO FORMULARIO ========
$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$cpf = trim($_POST["cpf"] ?? "");
if (empty($nome) || empty($email) || empty($cpf)) {
header("Location: index.php?erro=Campos+obrigatorios"); exit;
}
// == 3. PREPARED STATEMENT — INSERT SEGURO =====
$sql = "INSERT INTO clientes (nome, email, cpf)
VALUES (:nome, :email, :cpf)";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":cpf", $cpf);
try {
$stmt->execute();
header("Location: ../listar.php?msg=sucesso"); exit;
} catch (PDOException $erro) {
die("Erro ao cadastrar: " . $erro->getMessage());
}
?>