
$(document).ready(function(){

	var id = $("#tasktodo").attr("data-id");
    
	$(document).on('click', '.delete-subtask', function(){
		var root_url = window.location.hostname;
		taskid = $(this).attr('data-id');

		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/subtasks/delete_subtask.php",
		  dataType : 'text',
		  contentType : 'application/json',
		  data : JSON.stringify({id: taskid})
		}).done(function(msg){
		  //alert("Success");
		  subtasktodoInfo(id);
		  showSubTasks(id);
		}).fail(function(msg){
			console.log("error " + msg)
		  //alert("Error" + msg);
		});
	});
});