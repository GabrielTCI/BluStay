<?php
require_once "../conexao.php";
if (!isset($_GET['id_cliente']) || !is_numeric($_GET['id_cliente'])) {
header("Location: ../listar.php"); exit;
}
$id_cliente = (int) $_GET['id_cliente'];
// == 2. VERIFICACAO PREVIA — CONFIRMA QUE O HOSPEDE EXISTE
$check = $conexao->prepare(
"SELECT id_cliente FROM clientes WHERE id_cliente = :id_cliente LIMIT 1");
$check->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$check->execute();
if (!$check->fetch()) {
header('Location: listar.php'); exit;
}
// == 3. DELETE — REMOVE O REGISTRO DO BANCO ===========
$sql = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
try {

    $stmt->execute();

    header("Location: ../listar.php?msg=deletado");
    exit;

} catch (PDOException $erro) {

    if ($erro->getCode() == 23000) {

        header("Location: ../listar.php?msg=cliente_com_reserva");
        exit;
    }

    header("Location: ../listar.php?msg=erro_deletar");
    exit;
}
?>