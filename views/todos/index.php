
<div class="card">
  <div class="card-body">
    <h1 class="card-title">Liste des Todo</h1>
    <p class="card-text">Vous pouvez créer une Todo ainsi que les consulter</p>
    <a class="btn btn-primary" href="/todos/add">Ajouter une Todo</a>
  </div>
</div>
<form class="form-inline" method="post">
	<fieldset class="form-group">
		<label for="type">Trier par:</label>
		<select name="type" onchange='this.form.submit()'; required>
		  <option value="oldest">Trier par:</option>
			<option value="oldest" <?php if (isset($_POST['type']) && $_POST['type'] == 'oldest') {echo 'selected';}?>>Date</option>
			<option value="name" <?php if (isset($_POST['type']) && $_POST['type'] == 'name') {echo 'selected';}?>>Nom</option>
		</select>
	</fieldset>	
</form>
<div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nom de la liste</th>
      <th scope="col">Date de création</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
	<?php foreach($viewmodel as $todo_list) : ?>
    <tr>
    <td>
      <a href="/todos/tasks/<?php Helper::htmlout($todo_list['id']);?>"><?php Helper::htmlout($todo_list['name']);?></a>
    </td>
    <td>
      <p><?php Helper::dateFormat($todo_list['date_creation']);?></p>
    </td>
    <td>
      <a class="btn btn-info" href="/todos/update/<?php Helper::htmlout($todo_list['id']);?>">Mettre à jour</a>
    </td>
    <td>
      <form method="post">
        <div class="form-group">
          <input class="btn btn-danger" type="submit" name="delete_todo_list" value="Supprimer">
        </div>
        <input type="hidden" name="todo_id" value="<?php Helper::htmlout($todo_list['id']);?>"> 
      </form>
    </td> 
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
