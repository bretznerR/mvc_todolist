
<div class="card text-center">
  <div class="card-header">
    <h1>Bienvenue sur votre Todo App </h1>
    <h2><?php Helper::htmlout($_SESSION['USER']['firstname']); ?></h2>
  </div>
  <div class="card-body">
    <h5 class="card-title">Une Todo App avancée </h5>
    <p class="card-text">En effet, vous pouvez créer une liste, et dans cette liste, avoir des tâches personalisées</p>
    <a class="btn btn-primary text-center" href="<?php echo ROOT_PATH; ?>todos">On essaie ensemble ?</a>
  </div>
</div>