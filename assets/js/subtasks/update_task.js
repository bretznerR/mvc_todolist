
$(document).ready(function(){

	$(document).on('click', '.update-subtask', function(){
		var taskid = $(this).attr('data-id');
        readOneSubTask(taskid);
	});
    
    $(document).on('click', '.finish-subtask', function(){
		var taskid = $(this).attr('data-id');
                	    
	});

	var id = $("#tasktodo").attr("data-id");
	
	$(document).on('submit', '#update-subtask-form', function(){

        var form_data=JSON.stringify($(this).serializeObject());

		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/subtasks/update_subtask.php",
		  dataType : 'text',
		  contentType : 'application/json',
		  data : form_data
		}).done(function(msg){
		  subtasktodoInfo(id);
		  showSubTasks(id);
		  
		}).fail(function(msg){
			console.log("error " + JSON.stringify(msg))
		});
		 
		return false;
	});

});