
$(document).ready(function(){

	var id = $("#todo").attr("data-id");
    
	$(document).on('click', '.delete-task', function(){
		var root_url = window.location.hostname;
		taskid = $(this).attr('data-id');

		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/delete_task.php",
		  dataType : 'text',
		  contentType : 'application/json',
		  data : JSON.stringify({id: taskid})
		}).done(function(msg){
		  //alert("Success");
		  todoInfo(id);
		  showTasks(id);
		}).fail(function(msg){
			console.log("error " + msg)
		  //alert("Error" + msg);
		});
	});
});