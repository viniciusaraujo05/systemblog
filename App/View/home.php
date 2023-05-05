<?php
$postsController = new \App\Controller\PostsController();
?>
<!DOCTYPE html>
<html lang="PT-br">
<head>
    <title>MyBlog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">MyBLog</a>
    <ul class="navbar-nav mr-auto">
        <?php if (!empty($_SESSION['login'])) {?>
            <li class="nav-item">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCommentModal">
                    Novo Post
                </button>
            </li>
        <?php }?>
    </ul>
    <?php if (empty($_SESSION['login'])) {?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
        </ul>
    <?php } else {?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/logout">Sair</a>
            </li>
        </ul>
    <?php }?>


</nav>

<!--Modal para adicionar post-->
<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCommentModalLabel">NOVO POST</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/addPost" id="addPostForm" method="POST">
                    <div class="form-group">
                        <label for="commentTitle">Título do Post</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Insira o título">
                    </div>
                    <div class="form-group">
                        <label for="commentDescription">Descrição do comentário</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" id="submitPost" class="btn btn-primary">Adicionar Post</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--foearch para adicionar os posts existentes-->
<?php
foreach ($postsController->allPosts() as $post) { ?>
    <div class="col-md-8 mx-auto">
        <div class="border rounded p-3 shadow-lg mb-4">
            <h1><?php
                echo $post['title']; ?></h1>
            <p class="lead"><?php
                echo $post['description']; ?></p>
            <p><?php
                echo $post['author']; ?></p>

            <?php if (!empty($_SESSION['login'])) { ?>
                <?php if ($_SESSION['login']['0']['users'] === $post['author'] || $_SESSION['login']['0']['typeUser'] === 1) { ?>
                    <div class="d-inline-block mr-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCommentModal_<?php echo $post['id']; ?>">Editar</button>
                    </div>
                    <div class="d-inline-block">
                        <form action="/deletePost" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" onclick="return confirmDelete();" class="btn btn-danger" data-toggle="modal" data-target="#deleteCommentModal">Excluir</button>
                        </form>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

<!--Edit pots-->
    <div class="modal fade" id="editCommentModal_<?php
    echo $post['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel_<?php
    echo $post['id']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentModalLabel">Editar Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/updatePost" id="editPostForm" method="POST">
                        <input type="hidden" name="post_id" value="<?php
                        echo $post['id']; ?>">
                        <div class="form-group">
                            <label for="editTitle">Título do Post</label>
                            <input type="text" class="form-control" id="editTitle" name="title" placeholder="text"
                                   value="<?php
                                   echo $post['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Descrição do comentário</label>
                            <textarea class="form-control" id="editDescription" name="description" rows="3"><?php
                                echo $post['description']; ?></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="<?php
                        echo $post['id']; ?>">
                        <button type="submit" id="submitEditedPost" class="btn btn-primary">Salvar Alterações</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function confirmDelete() {
        return confirm("Tem certeza que deseja excluir este post?");
    }
</script>
</body>
</html>
