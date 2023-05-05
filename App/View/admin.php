<?php
$userController = new \App\Controller\UserController();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Painel</title>
    <!-- Inclua os arquivos CSS do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="card mt-3">
        <div class="card-header">
            <h1>Admin Painel</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newUserModal">
                Criar Novo Usuário
            </button>
            <a href="/" class="btn btn-danger mb-3 float-end">Voltar</a>
            <h2>Lista de Usuários</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo de acesso:</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($userController->allUsers() as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['users']; ?></td>
                        <td><?php echo $user['typeUser']; ?></td>
                        <td>
                            <form action="/deleteUser" method="POST">
                                <input type="hidden" name="post_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteCommentModal"><i class="bi bi-trash">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Criar Novo Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/addUser" method="POST">
                    <div class="mb-3">
                        <label for="username" class="col-form-label">Usuário:</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label">Senha:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="userType" class="col-form-label">Tipo de Usuário:</label>
                        <select class="form-select" id="userType" name="userType">
                            <option selected>Selecione um tipo de usuário</option>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuário Comum</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="submitPost" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Inclua os arquivos JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
