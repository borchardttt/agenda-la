<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/resources/views/styles/Login.css">
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="/app/Controllers/LoginController.php" method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="cadastro.php">Cadastre-se</a>
        <a href="esqueci_senha.php">Esqueci a senha</a>
    </div>
</body>

</html>