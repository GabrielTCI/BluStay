<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastrar Quarto</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>

<h1 class="titulo">BluStay</h1>

<div class="card">

<h2>Cadastrar Quarto</h2>

<p class="legenda">Cadastre um quarto do hotel.</p>

<form action="salvar_quarto.php" method="POST">

<label>Número do quarto</label>
<input type="text" name="numero" placeholder="Digite o número do quarto" required>

<label>Tipo de quarto</label>
<input type="text" name="tipo_quarto" placeholder="Ex: Solteiro, Casal, Suíte" required>

<label>Preço da diária</label>
<input type="number" name="preco_diaria" step="0.01" placeholder="Digite o preço da diária" required>

<label>Status</label>
<select name="status" required>
<option value="Disponível">Disponível</option>
<option value="Ocupado">Ocupado</option>
<option value="Manutenção">Manutenção</option>
</select>

<button type="submit" class="botao_cadastro">Cadastrar</button>

</form>

<div class="divider">
<span></span>
<p>ou</p>
<span></span>
</div>

<a href="quartos.php" class="botao_reservas">Ver Quartos</a>
<br>
<a href="index.php" class="botao_reservas">Voltar ao cadastro de hóspedes</a>

</div>

</body>
</html>