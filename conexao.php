<?php
// == ALTERE APENAS ESTAS 4 VARIÁVEIS ==============
$servidor = "localhost"; // Onde o MySQL roda
$banco = "sishotel"; // Nome do banco criado no Workbench
$usuario = "root"; // Usuário do MySQL
$senha = "root"; // Senha — vazio no XAMPP padrão
// ===================================================
try {
$conexao = new PDO(
"mysql:host=$servidor;dbname=$banco;charset=utf8mb4",
$usuario, $senha
);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $erro) {
die("Erro ao conectar: " . $erro->getMessage());
}
?>