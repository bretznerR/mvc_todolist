$(document).ready(function(){

	var id = $("#todo").attr("data-id");
    
	$(document).on('click', '.finish-task', function(){

		taskid = $(this).attr('data-id');

		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/finish_task.php",
		  dataType : 'json',
		  contentType : 'application/json',
		  data : JSON.stringify({id: taskid})
		}).done(function(msg){
		  todoInfo(id);
		  showTasks(id);
		}).fail(function(msg){
		  console.log("Error" + msg);
		});
	});
});