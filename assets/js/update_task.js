
$(document).ready(function(){

	$(document).on('click', '.update-task', function(){
		var taskid = $(this).attr('data-id');
        readOneTask(taskid);        	    
	});
    
    $(document).on('click', '.finish-task', function(){
		var taskid = $(this).attr('data-id');
                	    
	});

	var id = $("#todo").attr("data-id");
	
	$(document).on('submit', '#update-task-form', function(){

        var form_data=JSON.stringify($(this).serializeObject());

		$.ajax({
		  method: "POST",
		  url: "http://" + root_url + "/api/update_task.php",
		  dataType : 'text',
		  contentType : 'application/json',
		  data : form_data
		}).done(function(msg){
		  todoInfo(id);
		  showTasks(id);
		  
		}).fail(function(msg){
			console.log("error " + JSON.stringify(msg))
		});
		 
		return false;
	});

});