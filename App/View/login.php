
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<div class="container vertical-center">
    <div class="login-container">
        <h1 class="text-center">BEM VINDO AO MYBLOG</h1>
        <h2>Login</h2>
        <form action="/checkUser" method="post">
            <div class="form-group">
                <label for="username">Nome de usuário:</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        <br>
        <a href="/loginGuest" type="button" onclick="return confirmGuest();" class="btn btn-link guest-button">Acesso como visitante</a>
    </div>
</div>
</body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .login-container {
        max-width: 500px;
        margin: 0 auto;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
    }
    .vertical-center {
        min-height: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .guest-button {
        text-decoration: underline;
    }
</style>

<script>
    function confirmGuest() {
        return confirm("Olá! Ao acessar o nosso blog como visitante, você poderá apenas criar novos posts," +
            " visualizar posts dos nossos usuarios." +
            " A função editar e excluir é somente para membros registrados.");
    }
</script>

</html>