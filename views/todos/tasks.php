
<div class="card">
  <div class="card-body">
      <?php foreach($viewmodel as $todo_list) :
      if ($todo_list['id'] == $_GET['id'] ) {
          $task = $todo_list;

      }
      endforeach;?>
    <h1 id="todo" data-id="<?php Helper::htmlout($_GET['id']);?>"><?php Helper::htmlout($task['name']); ?></h1>
    <p>Liste créée le : <?php Helper::htmlout($task['date_creation']); ?></p>
    <div id="info"></div>
  </div>
  
</div>
<div id="task-form-div">
  <form id="create-task-form" class="bg-info table form-inline" method="post">
    <fieldset class="form-group">
    <label for="name">Nom de la tâche:</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la tâche" value="" required>
    </fieldset>

    <fieldset class="form-group">
    <label for="priority">Priorité:</label>
    <select id="priority" name="priority">
      <option value="low">low</option>
      <option value="normal">normal</option>
      <option value="high">high</option>
    </select>
    </fieldset>

    <fieldset class="form-group">
    <label for="deadline">Date limite:</label>
    <input type="date" class="form-control" id="deadline" name="deadline" placeholder="MM/DD/YYY" value="" required>
    </fieldset>
      <input type="hidden" name="todoID" value="<?php Helper::htmlout($_GET['id']); ?>">
    <button class="create-task btn btn-default" type="submit" name="create_task" role="button">Créer la tâche</button>
    </form> 
    <div id="tasks_liste" data-id="<?php Helper::htmlout($_GET['id']);?>">
      
    </div>
</div>