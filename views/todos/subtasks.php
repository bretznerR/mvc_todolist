
<div class="card">
    <div class="card-body">
        <?php if (sizeof($viewmodel) > 0) {
            foreach($viewmodel as $todo_list) :
                if ($todo_list['id'] == $_GET['id'] ) {
                    $task = $todo_list;

                }
        endforeach;
        }?>
        <h1 id="tasktodo" data-id="<?php Helper::htmlout($_GET['id']);?>"><?php Helper::htmlout($task['name']); ?></h1>
        <p>Tâche créée le : <?php Helper::htmlout($task['deadline']); ?></p>
        <div id="info"></div>
    </div>

</div>
<div id="subtask-form-div">
    <form id="create-subtask-form" class="bg-info table form-inline" method="post">
        <fieldset class="form-group">
            <label for="name">Nom de la sous-tâche:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la sous-tâche" value="" required>
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
        <input type="hidden" name="taskID" value="<?php Helper::htmlout($_GET['id']); ?>">
        <button class="create-task btn btn-default" type="submit" name="create_subtask" role="button">Créer la tâche</button>
    </form>
    <div id="subtasks_liste" data-id="<?php Helper::htmlout($_GET['id']);?>">

    </div>
</div>