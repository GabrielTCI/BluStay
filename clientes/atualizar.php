<?php
require_once "../conexao.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
header("Location: ../listar.php"); exit;
}
// == 2. CAPTURA DOS DADOS (inclui id do campo hidden) ==
$id_cliente = (int) ($_POST["id_cliente"] ?? 0);
$nome = trim( $_POST["nome"] ?? "");
$email = trim( $_POST["email"] ?? "");
$cpf = trim( $_POST["cpf"] ?? "");
if ($id_cliente <= 0 || empty($nome) || empty($email) || empty($cpf)) {
die("Erro: Dados inválidos ou incompletos.");
}
// == 3. UPDATE SEGURO — WHERE id = :id OBRIGATORIO ====
$sql = "UPDATE clientes
SET nome = :nome,
email = :email,
cpf = :cpf
WHERE id_cliente = :id_cliente";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":nome", $nome);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":cpf", $cpf);
$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
try {
$stmt->execute();
header("Location: ../listar.php?msg=editado"); exit;
} catch (PDOException $erro) {
die("Erro ao atualizar: " . $erro->getMessage());
}
?>