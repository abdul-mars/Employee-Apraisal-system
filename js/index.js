$(document).ready(function(){
	// fetch tasks when employee changes
	$('#employee').change(function () {
		var employee = $('#employee').val(); //alert(employee);
		if (employee != '') {
			// alert('working');
			$.ajax({
				url: 'operations.php?operation=fetch_tasks&employee=employee',
				type: 'post',
				data: {employee: employee},
				success: function(data){
					// alert(data);
					$('#task').html(data);
				}
			})
		} else {
			$('#task').html('<option value="">Select Employee first</option>');
		}
	});


	// new evaluation
	$('#evaluationSubmit').click(function () {
		var data = {
			'employee': $('#employee').val(),
			'task': $('#task').val(),
			'evaluator': $('#evaluator').val(),
			'efficiency': $('#efficiency').val(),
			'timeliness': $('#timeliness').val(),
			'quality': $('#quality').val(),
			'accuracy': $('#accuracy').val(),
			'quality': $('#quality').val(),
			'remark': $('#remark').val(),
			'evaluationSubmit': true,
			// $task = $_POST['task'];
			// $efficiency = $_POST['efficiency'];
			// $timeliness = $_POST['timeliness'];
			// $quality = $_POST['quality'];
			// $accuracy = $_POST['accuracy'];
			// $remark = $_POST['remark'];
		}; //console.log(data);
		
		$.ajax({
			url: 'operations.php?operation=evaluation',
			type: 'post',
			data: data,
			success: function(response){ 
				// alert(response);
				if (response == 1) {
					// $('#newEvaluation').modal().hide();
					window.location.replace('evaluation.php?msg=New evaluation added successfully&cssClass=alert-success');
					// alert('saved');
				} else {
					alert('Unable to add new evaluation');
					// alert(response);
				}
			}
		});
	});

	// admin login 
	$('#loginSubmit').click(function() { //alert('workink');
		var data = {
			'email': $('#email').val(),
			'password': $('#password').val(),
			// 'fTime': $('#fTime').val(),
			// 'fTime': $('input[name="fTime"]:checked').val();
			'loginSubmit': true,
		}; //console.log(data);
		$.ajax({
			url: 'operations.php?operation=admin_login',
			type: 'post',
			data: data,
			success: function(response){
				// alert(response);
				if (response == 1) {
					window.location.replace('first_login.php');
				} else if (response == 2) {
					window.location.replace('index.php');
				} else {
					// alert(response);
					$('.error').html(response);
				}
			}
		})
	});

	// user login
	$('#userLoginSubmit').click(function() { //alert('workink');
		var data = {
			'email': $('#email').val(),
			'password': $('#password').val(),
			// 'fTime': $('#fTime').val(),
			// 'fTime': $('input[name="fTime"]:checked').val();
			'userLoginSubmit': true,
		}; //console.log(data);
		$.ajax({
			url: 'operations.php?operation=user_login',
			type: 'post',
			data: data,
			success: function(response){
				// alert(response);
				if (response == 1) {
					window.location.replace('user_first_login.php');
				} else if (response == 2) {
					window.location.replace('welcome.php');
				} else {
					// alert(response);
					$('.error').html(response);
				}
			}
		})
	});
});