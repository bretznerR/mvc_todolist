
<div class="card">
  <div class="card-header">
    <h1>Update Todo Form</h1>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

      <div class="form-group">
        <label for="name">Nom de la liste</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php Helper::htmlout($viewmodel['name']);?>" aria-describedby="" placeholder="Todo Name">
      </div>
      <input type="hidden" name="todo_id" value="<?php Helper::htmlout($_GET['id']);?>">
      <input type="submit" class="btn btn-primary" name="update_todo" value="Mettre à jour">
      <a class="btn btn-primary" href="<?php echo "http://" . ROOT_URL; ?>todos">Annuler</a>
    </form>
    </div>
  </div>
</div>

