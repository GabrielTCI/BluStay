<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Hotel</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="titulo">BluStay</h1>

<div class="card">

<h2>Cadastrar Hóspede</h2>

<p class="legenda">Cadastre sua reserva em nosso Hotel.</p>

<form action="clientes/salvar.php" method="POST">

<label>Nome completo</label>
<input type="text" name="nome" placeholder="Digite seu nome completo" required>

<label>E-mail</label>
<input type="email" name="email" placeholder="Digite seu e-mail" required>

<label>CPF</label>
<input type="text" name="cpf" placeholder="Digite seu CPF" required>

<button type="submit" class="botao_cadastro">Cadastrar</button>

</form>

<div class="divider">
<span></span>
<p>menu</p>
<span></span>
</div>

<a href="listar.php" class="botao_reservas">Ver Hóspedes</a>
<br>
<a href="quartos.php" class="botao_reservas">Ver Quartos</a>
<br>
<a href="reservas.php" class="botao_reservas">Ver Reservas</a>
<br>
<a href="pagamentos.php" class="botao_reservas">Ver Pagamentos</a>

</div>

</body>
</html>