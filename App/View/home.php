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
		<li class="nav-item">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCommentModal">
				Novo Post
			</button>
		</li>
	</ul>
</nav>

<div class="modal fade" id="addCommentModal" tabindex="-1" role="dialog" aria-labelledby="addCommentModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addCommentModalLabel">NOVO POST</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="addPostForm" method="POST">
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

<?php foreach ($postsController->posts() as $post) { ?>
	<div class="col-md-8 mx-auto">
		<div class="border rounded p-3 shadow-lg mb-4">
			<h1><?php echo $post['title']; ?></h1>
			<p class="lead"><?php echo $post['description']; ?></p>
			<p><?php echo $post['author']; ?></p>
		</div>
	</div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		$('#addPostForm').submit(function(event) {
			event.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'http://localhost/addPost',
				data: $(this).serialize(),
				success: function(response) {
					alert("post feito com sucesso");
					location.reload();
				},
				error: function(xhr, status, error) {
					alert("Deu RUim")
				}
			});
		});
	});
</script>
</body>
</html>
