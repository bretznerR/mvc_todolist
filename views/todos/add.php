
<div class="card">
  <div class="card-header">
    <h1>Créer une Todo</h1>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

      <div class="form-group">
        <label for="name">Nom de la Todo</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="" placeholder="Nom de la Todo">
      </div>
      <input type="hidden" name="id" value="<?php Helper::htmlout($_SESSION['USER']['ID']);?>">
      <input type="submit" class="btn btn-primary" name="create_todo" value="Ajouter la Todo">
      <a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>todos">Annuler</a>
    </form>
    </div>
  </div>
</div>