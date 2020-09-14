$(document).ready(function(){

	var id = $("#tasktodo").attr("data-id");

	$(document).on('submit', '#create-subtask-form', function(){

		var form_data=JSON.stringify($(this).serializeObject());

		$.ajax({
			method: "POST",
			url: "http://" + root_url + "/api/subtasks/create_subtask.php",
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
			subtasktodoInfo(id);
			showSubTasks(id);
		}).error(function(msg){
			console.log("status" + JSON.stringify(msg.status));
			console.log("statustext" + JSON.stringify(msg.statusText));
			console.log("message" + JSON.stringify(msg));
		});
		return false;
	});


});