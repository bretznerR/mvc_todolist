$(document).ready(function(){

	var id = $("#todo").attr("data-id");

	$(document).on('submit', '#create-task-form', function(){

        var form_data=JSON.stringify($(this).serializeObject());
		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/create_task.php",
		  timeout: 0,
			dataType: 'text',
		  headers: {
				ContentType: "application/json",
			},
		  data : form_data
		}).success(function(msg){
		  //alert("Success");
		  $("#create-task-form").trigger('reset');
		  //$("#create-task-form")[0].reset();
		  todoInfo(id);
		  showTasks(id);
		}).error(function(msg){
			console.log("status" + JSON.stringify(msg.status));
			console.log("statustext" + JSON.stringify(msg.statusText));
			console.log("message" + JSON.stringify(msg));
		});
		return false;
	});

	
});