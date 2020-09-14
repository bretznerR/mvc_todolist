

var root_url = window.location.hostname;
var current_url = window.location.href;

function showSubTasks(taskID)
{

	$.getJSON("http://" + root_url + "/api/subtasks/read_subtasks.php?id=" + taskID, function(data){
		empty_div = "<div>Aucune tâche</div>";
		read_tasks="";
        read_tasks += "<table class='table'>";
			read_tasks += "<thead>";
			    read_tasks += "<tr>";
			      read_tasks += "<th scope='col'>Nom de la sous tâche</th>";
			      read_tasks += "<th scope='col'>Priorité</th>";
			      read_tasks += "<th scope='col'>Date limite</th>";
			      read_tasks += "<th scope='col'>Statut</th>";
			      read_tasks += "<th scope='col'>Temps restant</th>";
			      read_tasks += "<th scope='col'></th>";
			      read_tasks += "<th scope='col'></th>";
			      read_tasks += "<th scope='col'></th>";
			    read_tasks += "<tr>";
			 read_tasks += "<thead>";
		  read_tasks += "<tbody>";
		$.each(data, function(key, val){
		    read_tasks += "<tr class='task"+val.taskid+"' id='task'>";
		      read_tasks += "<td>" + val.name + "</td>";
		      read_tasks += "<td>" + val.priority + "</td>";
		      read_tasks += "<td>" + val.deadline + "</td>";
		      read_tasks += "<td>" + val.status + "</td>";

		      if (val.status == "completed") {
                read_tasks += "<td>-</td>";
		      }else if(val.datediff < 0){
		      	read_tasks += "<td><span class='badge badge-warning'>Retard de </span> " + Math.abs(val.datediff) + " jours</td>";
		      }else{
		      	read_tasks += "<td>" + Math.abs(val.datediff) + " journées</td>";
		      }
		      if (val.status == "no completed") {
		      	read_tasks += "<td><button data-id='"+val.subtaskid+"' type='button' class=' finish-subtask btn btn-outline-success'>Terminer</button></td>";
		      }else{
		      	read_tasks += "<td><button data-id='"+val.subtaskid+"' type='button' class=' finish-subtask btn btn-outline-success' disabled>Terminer</button></td>";
		      }

		      read_tasks += "<td><button data-id='"+val.subtaskid+"' type='button' class=' update-subtask btn btn-outline-primary'>Mettre à jour</button></td>";
		      read_tasks += "<td><button data-id='"+val.subtaskid+"' type='button' class=' delete-subtask btn btn-outline-danger'>Supprimer</button></td>";
		    read_tasks += "</tr>";

		});
		  read_tasks += "</tbody>";
		read_tasks += "</table>";
		if (data) {
			var count = Object.keys(data).length;
			if (!data ||data == null || !data[0] || data[0]['name'] == null) {
				$('#subtasks_liste').html(empty_div);
			}else{
				$('#subtasks_liste').html(read_tasks);
			}
		}
	});
}


function readOneSubTask(taskid)
{
	$.getJSON("http://" + root_url + "/api/subtasks/read_subtask_by_id.php?id=" + taskid, function(data){

        var taskid = data[0]['id'];
		var taskName = data[0]['name'];
		var priority = data[0]['priority'];
		var deadline = data[0]['deadline'];
		var status = data[0]['status'];

		update_form = "";
		    update_form += "<form id='update-subtask-form' class='form-inline' method='post'>";
		    update_form += "<input type='hidden' name='id' value='"+taskid+"'>";
		    update_form += "<fieldset class='form-group'>";
			update_form += "<label for='name'>Nom de la tâche:</label>";
			update_form += "<input type='text' class='form-control' id='naziv_taska' name='task_name' placeholder='Nom de la tâche' value='"+taskName+"' required>";
			update_form += "</fieldset>";
			update_form += "<fieldset class='form-group'>";
			update_form += "<label for='task_name'>Date limite:</label>";
			update_form += "<input type='date' class='form-control' id='deadline' name='deadline' placeholder='Date limite' value='"+deadline+"' required>";
			update_form += "</fieldset>";				
			update_form += "<fieldset class='form-group'>";
			update_form += "<label for='prioritet'>Priorité:</label>";
			update_form += "<select id='prioritet' name='priority'>";
			$.each(data[1], function(key, val){
				if (val.taskid == priority) {
					update_form += "<option value='" + val.id + "' selected>" + val.id + "</option>";
				}else{
					update_form += "<option value='" + val.id + "'>" + val.id + "</option>";
				}             		    	      	 		      		            		      
			});
			update_form += "</select>";
            update_form += "<fieldset class='form-group'>";
			update_form += "<label for='task_name'>Statut:</label>";
			update_form += "<select id='status' name='status'>";
			$.each(data[2], function(key, val){ 
				if (val.taskid == status) {
					update_form += "<option value='" + val.id + "' selected>" + val.id + "</option>";
				}else{
					update_form += "<option value='" + val.id + "'>" + val.id + "</option>";
				}             		    	      	 		      		            		      
			});
			update_form += "</select>";
			update_form += "</fieldset>";
			update_form += "<fieldset class='form-group'>";
			update_form += "<button class='update-subtask-action btn btn-primary' type='submit' name='update_subtask' role='button'>Mettre à jour</button>";
			update_form += "<a class='btn btn-secondary' href='"+current_url+"'>Annuler</a>";

			update_form += "</fieldset>";			
		   update_form += "</form>";
     $('#subtasks_liste').html(update_form);
		   
	});
}

function subtasktodoInfo(todoID)
{

	$.getJSON("http://" + root_url + "/api/subtasks/todo_info.php?id=" + todoID, function(data){
		var status = data.status;
		var total = data.total;
		var noCompleted = data.unfinished;
		var completed = parseFloat(data.finished).toFixed(2);

		todo_info = "";
		todo_info += "<table class='table'>";
		todo_info += "<tr>";
		todo_info += "<td>Total des sous-tâches: "+total+" </td>";
		todo_info += "<td>Sous-tâches inachevées: "+noCompleted+" </td>";
		if (total == 0) {
			todo_info += "<td> Terminé: - % </td>";
		}else{
			todo_info += "<td> Terminé: "+completed+" % </td>";
		}
		todo_info += "<tr>";
		todo_info += "</table>";
		$('#info').html(todo_info);
	});
}

$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
