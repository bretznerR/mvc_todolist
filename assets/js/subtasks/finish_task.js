$(document).ready(function(){

	var id = $("#tasktodo").attr("data-id");
    
	$(document).on('click', '.finish-subtask', function(){

		taskid = $(this).attr('data-id');

		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/subtasks/finish_subtask.php",
		  dataType : 'json',
		  contentType : 'application/json',
		  data : JSON.stringify({id: taskid})
		}).done(function(msg){
		  subtasktodoInfo(id);
		  showSubTasks(id);
		}).fail(function(msg){
		  console.log("Error" + msg);
		});
	});
});