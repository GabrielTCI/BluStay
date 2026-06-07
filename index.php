
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Hotel</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="titulo">BluStay</h1>

<div class = "card">

<h2>Cadastrar</h2>

<p class="legenda">Cadastre sua reserva em nosso Hotel.</p>

<form action="salvar.php" method="POST">

<label>Nome completo</label>
<input type="text" name="nome" placeholder=" Digite seu nome completo" required>

<label>E-mail</label>
<input type="email" name="email" placeholder=" Digite seu e-mail" required>

<label>CPF</label>
<input type="text" name="cpf" placeholder=" Digite seu CPF" required>

<button type="submit" class="botao_cadastro">Cadastrar</button>

</form>

  <div class="divider">
      <span></span>
      <p>ou</p>
      <span></span>
    </div>

<a href="listar.php" class="botao_reservas">Minhas Reservas</a>

</div>

</body>

</html>
