<?php session_start();
	require_once 'dbConnect.php';

	// fetch tasks
	if (@$_GET['operation'] == 'fetch_tasks') {
		// echo "string";
		$employee = $_POST['employee'];
		// echo $employee;
		$sql = mysqli_query($con, "SELECT * FROM `task_list` WHERE employee_id = '$employee'");
		while ($data = mysqli_fetch_assoc($sql)) {
			$task = $data['task'];
			$taskId = $data['id'];
			echo '<option value="'.$taskId.'">'.$task.'</option>';
		}
	}

	// add new evaluation
	if (@$_GET['operation'] == 'evaluation') {
		if (isset($_POST['evaluationSubmit'])) {
			$employee = $_POST['employee'];
			$task = $_POST['task'];
			$evaluator = $_POST['evaluator'];
			$efficiency = $_POST['efficiency'];
			$timeliness = $_POST['timeliness'];
			$quality = $_POST['quality'];
			$accuracy = $_POST['accuracy'];
			$remark = $_POST['remark'];

			// echo $employee; echo "<br>";
			// echo $task; echo "<br>";
			// echo $efficiency; echo "<br>";
			// echo $timeliness; echo "<br>";
			// echo $quality; echo "<br>";
			// echo $accuracy; echo "<br>";
			// echo $remark; echo "<br>";

			$sql = mysqli_query($con, "INSERT INTO `ratings`(`employee_id`, `task_id`, `evaluator_id`, `efficiency`, `timeliness`, `quality`, `accuracy`, `remarks`) VALUES ('$employee','$task','$evaluator','$efficiency','$timeliness','$quality','$accuracy','$remark')");
			if ($sql) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	// update evaluation
	if (@$_GET['operation'] == 'update_evaluation') {
		if (isset($_POST['updateEvaluation'])) {
			$employee = $_POST['employee'];
			$task = $_POST['task'];
			$efficiency = $_POST['efficiency'];
			$quality = $_POST['quality'];
			$timeliness = $_POST['timeliness'];
			$accuracy = $_POST['accuracy'];
			$remark = $_POST['remark'];
			$evaId = $_POST['evaluationId'];

		// 	echo $employee; echo "<br>";
		// 	echo $task; echo "<br>";
		// 	echo $efficiency; echo "<br>";
		// 	echo $timeliness; echo "<br>";
		// 	echo $quality; echo "<br>";
		// 	echo $accuracy; echo "<br>";
		// 	echo $remark; echo "<br>";
		// 	echo $evaId; echo "<br>";

			$sql = mysqli_query($con, "UPDATE `ratings` SET `efficiency`='$efficiency',`timeliness`='$timeliness',`quality`='$quality',`accuracy`='$accuracy',`remarks`='$remark' WHERE `id` = '$evaId'");
			if ($sql) {
				$msg = 'updated successfully';
				$cssClass = 'alert-success';
				header("location: evaluation.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to update';
				$cssClass = 'alert-danger';
				header("location: evaluation.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// delete evaluation
	if (@$_GET['operation'] == 'delete_evaluation') {
		if (isset($_POST['delSubmit'])) {
			$delId = $_POST['delId'];

			$sql = mysqli_query($con, "DELETE FROM `ratings` WHERE `id` = '$delId'");
			if ($sql) {
				$msg = 'evaluation deleted successfully';
				$cssClass = 'alert-success';
				header("location: evaluation.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to delete evaluation';
				$cssClass = 'alert-danger';
				header("location: evaluation.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// add department
	if (@$_GET['operation'] == 'add_deparment') {
		if (isset($_POST['addDepSubmit'])) {
			$department = $_POST['department'];
			$desc = $_POST['desc'];

			// echo $department; echo "<br>";
			// echo $desc;

			$sql = mysqli_query($con, "INSERT INTO `department_list`(`department`, `description`) VALUES ('$department','$desc')");
			if ($sql) {
				$msg = 'Department added successfully';
				$cssClass = 'alert-success';
				header("location: departments.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to add department';
				$cssClass = 'alert-danger';
				header("location: departments.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// update department
	if (@$_GET['operation'] == 'update_deparment') {
		if (isset($_POST['updateDepSubmit'])) {
			$department = $_POST['department'];
			$desc = $_POST['desc'];
			$depId = $_POST['depId'];

			// echo $department; echo "<br>";
			// echo $desc;

			$sql = mysqli_query($con, "UPDATE `department_list` SET `department`='$department',`description`='$desc' WHERE `id` = '$depId'");
			if ($sql) {
				$msg = 'Department updated successfully';
				$cssClass = 'alert-success';
				header("location: departments.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to update department';
				$cssClass = 'alert-danger';
				header("location: departments.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// delete department
	if (@$_GET['operation'] == 'delete_deparment') {
		if (isset($_POST['delSubmit'])) {
			$delId = $_POST['delId'];

			$sql = mysqli_query($con, "DELETE FROM `department_list` WHERE `id` = '$delId'");
			if ($sql) {
				$msg = 'Department deleted successfully';
				$cssClass = 'alert-success';
				header("location: departments.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to delete department';
				$cssClass = 'alert-danger';
				header("location: departments.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// add designation
	if (@$_GET['operation'] == 'add_designation') {
		if (isset($_POST['addDesigSubmit'])) {
			$designation = $_POST['designation'];
			$desc = $_POST['desc'];

			// echo $designation; echo "<br>";
			// echo $desc;

			$sql = mysqli_query($con, "INSERT INTO `designation_list`(`designation`, `description`) VALUES ('$designation','$desc')");
			if ($sql) {
				$msg = 'designation added successfully';
				$cssClass = 'alert-success';
				header("location: designations.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to add designation';
				$cssClass = 'alert-danger';
				header("location: designations.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// update designation
	if (@$_GET['operation'] == 'update_designation') {
		if (isset($_POST['updateDesignSubmit'])) {
			$designation = $_POST['designation'];
			$desc = $_POST['desc'];
			$designId = $_POST['designId'];

			// echo $designation; echo "<br>";
			// echo $desc;

			// $sql = mysqli_query($con, "INSERT INTO `designation_list`(`designation`, `description`) VALUES ('$designation','$desc')");
			$sql = mysqli_query($con, "UPDATE `designation_list` SET `designation`='$designation',`description`='$desc' WHERE `id` = '$designId'");
			if ($sql) {
				$msg = 'designation added successfully';
				$cssClass = 'alert-success';
				header("location: designations.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to add designation';
				$cssClass = 'alert-danger';
				header("location: designations.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// delete department
	if (@$_GET['operation'] == 'delete_designation') {
		if (isset($_POST['designSubmit'])) {
			$designId = $_POST['designId'];

			$sql = mysqli_query($con, "DELETE FROM `designation_list` WHERE `id` = '$designId'");
			if ($sql) {
				$msg = 'Designation deleted successfully';
				$cssClass = 'alert-success';
				header("location: designations.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to delete designation';
				$cssClass = 'alert-danger';
				header("location: designations.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// add employee
	if (@$_GET['operation'] == 'add_employee') {
		if (isset($_POST['addEmpSubmit'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$department = $_POST['department'];
			$designation = $_POST['designation'];
			// $firstname = $_POST['firstname'];

			// echo $firstname; echo "<br>";
			// echo $lastname; echo "<br>";
			// echo $email; echo "<br>";
			// echo $department; echo "<br>";
			// echo $designation; echo "<br>";
			// echo $firstname; echo "<br>";

			$sql = mysqli_query($con, "INSERT INTO `employee_list`(`firstname`, `lastname`, `email`, `department_id`, `designation_id`) VALUES ('$firstname','$lastname','$email','$department','$designation')");
			if ($sql) {
				$msg = 'Employee added successfully';
				$cssClass = 'alert-success';
				header("location: employees.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to add employee';
				$cssClass = 'alert-danger';
				header("location: employees.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// delete employee
	if (@$_GET['operation'] == 'delete_employee') {
		if (isset($_POST['delEmpSubmit'])) {
			$delEmpId = $_POST['delEmpId'];

			$sql = mysqli_query($con, "DELETE FROM `employee_list` WHERE `id` = '$delEmpId'");
			if ($sql) {
				$msg = 'Employee deleted successfully';
				$cssClass = 'alert-success';
				header("location: employees.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to delete employee';
				$cssClass = 'alert-danger';
				header("location: employees.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// add evaluator
	if (@$_GET['operation'] == 'add_evaluator') {
		if (isset($_POST['addEvaSubmit'])) {
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$token = $_POST['token'];

			// echo $firstname; echo "<br>";
			// echo $lastname; echo "<br>";
			// echo $email; echo "<br>";
			// echo $token; echo "<br>";

			$sql = mysqli_query($con, "INSERT INTO `evaluator_list`(`firstname`, `lastname`, `email`, `token`) VALUES ('$firstname','$lastname','$email','$token')");
			if ($sql) {
				$msg = 'Evaluator added successfully';
				$cssClass = 'alert-success';
				header("location: evaluators.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to add evaluator';
				$cssClass = 'alert-danger';
				header("location: evaluators.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// delete department
	if (@$_GET['operation'] == 'delete_evaluator') {
		if (isset($_POST['delSubmit'])) {
			$delId = $_POST['delId'];

			$sql = mysqli_query($con, "DELETE FROM `evaluator_list` WHERE `id` = '$delId'");
			if ($sql) {
				$msg = 'Evaluator deleted successfully';
				$cssClass = 'alert-success';
				header("location: evaluators.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to delete evaluator';
				$cssClass = 'alert-danger';
				header("location: evaluators.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// add task
	if (@$_GET['operation'] == 'add_task') {
		if (isset($_POST['addTaskSubmit'])) {
			$task = $_POST['task'];
			$assigned = $_POST['assigned'];
			$desc = $_POST['desc'];
			$dueDate = $_POST['dueDate'];

			// echo $task; echo "<br>";
			// echo $assigned; echo "<br>";
			// echo $desc; echo "<br>";

			$sql = mysqli_query($con, "INSERT INTO `task_list`(`task`, `description`, `employee_id`, `due_date`, `status`) VALUES ('$task','$desc','$assigned','$dueDate','0')");
			if ($sql) {
				$msg = 'Task added successfully';
				$cssClass = 'alert-success';
				header("location: tasks.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to add task';
				$cssClass = 'alert-danger';
				header("location: tasks.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// update task
	if (@$_GET['operation'] == 'update_task') {
		if (isset($_POST['updateTaskSubmit'])) {
			$taskId = $_POST['taskId'];
			$task = $_POST['task'];
			$assigned = $_POST['assigned'];
			$desc = $_POST['desc'];
			$dueDate = $_POST['dueDate'];

			// echo $taskId; echo "<br>";
			// echo $task; echo "<br>";
			// echo $assigned; echo "<br>";
			// echo $desc; echo "<br>";
			// echo $dueDate; echo "<br>";

			$sql = mysqli_query($con, "UPDATE `task_list` SET `task`='$task',`description`='$desc',`employee_id`='$assigned',`due_date`='$dueDate' WHERE `id` = '$taskId'");
			if ($sql) {
				$msg = 'Task updated successfully';
				$cssClass = 'alert-success';
				header("location: tasks.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to update task';
				$cssClass = 'alert-danger';
				header("location: tasks.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// delete task
	if (@$_GET['operation'] == 'delete_task') {
		if (isset($_POST['delSubmit'])) {
			$delId = $_POST['delId'];

			$sql = mysqli_query($con, "DELETE FROM `task_list` WHERE `id` = '$delId'");
			if ($sql) {
				$msg = 'Task deleted successfully';
				$cssClass = 'alert-success';
				header("location: tasks.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'unable to delete task';
				$cssClass = 'alert-danger';
				header("location: tasks.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// admin login
	if (@$_GET['operation'] == 'admin_login') {
		if (isset($_POST['loginSubmit'])) {
			// echo 'workingdfdf';
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			// echo $email;
			// echo "<br>";
			// echo $password;

			if (empty($email)) {
				echo "Please enter you email";
			} else {
				if (empty($password)) {
					echo "Please enter your password";
				} else {
					// $password = md5($password);
					$sql = mysqli_query($con, "SELECT * FROM `evaluator_list` WHERE email = '$email' AND token = '$password'");
					if (mysqli_num_rows($sql) >= 1) {
						// session_start();
						$data = mysqli_fetch_assoc($sql);
						$_SESSION['email'] = $data['email'];
						$_SESSION['lastname'] = $data['lastname'];
						$_SESSION['firstname'] = $data['firstname'];
						$_SESSION['id'] = $data['id'];

						echo 1;
						exit();
					} else {
						$password = md5($password);
						$sql = mysqli_query($con, "SELECT * FROM `evaluator_list` WHERE email = '$email' AND password = '$password'");
						if (mysqli_num_rows($sql) > 0) {
							// session_start();
							$data = mysqli_fetch_assoc($sql);
							$_SESSION['email'] = $data['email'];
							$_SESSION['lastname'] = $data['lastname'];
							$_SESSION['firstname'] = $data['firstname'];
							$_SESSION['id'] = $data['id'];
							$_SESSION['password'] = $data['password'];

							echo 2;
						} else {
							echo "Wrong email and or Password";
						}
					}
				} 
			}
		}
	}

	// admin first time login
	if (@$_GET['operation'] == 'admin_first_time') {
		if (isset($_POST['adminFirstTimeSubmit'])) {
			$email = $_SESSION['email'];
			$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
			// $email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
			// $picture = $_FILES['picture'];

			// echo $firstname; echo '<br>';
			// echo $lastname; echo '<br>';
			// // echo $email; echo '<br>';
			// echo $password; echo '<br>';
			// echo $confirmPassword; echo '<br>';
			// // echo $firstname; echo '<br>';
			// print_r($picture);

			if (empty($password)) {
				$msg = 'please enter password';
				$cssClass = 'alert-danger';
				header("location: first_login.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				if (strlen($password) < 6) {
					$msg = 'Your password cannot be less than 6 characters long';
					$cssClass = 'alert-danger';
					header("location: first_login.php?msg=$msg&cssClass=$cssClass");
					exit();
				} else {
					if ($password != $confirmPassword) {
						$msg = 'Your passwords do not match';
						$cssClass = 'alert-danger';
						header("location: first_login.php?msg=$msg&cssClass=$cssClass");
						exit();
					} else {
						$password = md5($password);
						if (isset($_FILES['picture'])) {
							$picture = $_FILES["picture"]['name'];
			                $pictureSize = $_FILES["picture"]['size'];
			                $tmpName = $_FILES["picture"]['tmp_name'];

			                // create extension array for accepted file format
			                $pictureValidExtension = ['jpg', 'jpeg', 'png'];
			                $pictureExtension = explode('.', $picture);
			                $pictureExtension = strtolower(end($pictureExtension));

			                // check to see if selected is in the accepted file format extension array
			                if(!in_array($pictureExtension, $pictureValidExtension)) {
			                    // echo "<script> alert('Unsupported File Format'); <scritp>";
			                    $msg = 'Unsupported File Format. please try again';
			                    $cssClass = 'alert-danger';
			                    header("location: first_login.php?page=edit&msg=$msg&cssClass=$cssClass");
			                    exit();
			                    // echo $msg;
			                } else if($pictureSize > 3000000){ // check if profile pic is larger than 3mb
			                    $msg = 'Image Size Is Too Large. please try again';
			                    $cssClass = 'alert-danger';
			                    header("location: first_login.php?page=edit&msg=$msg&cssClass=$cssClass");
			                    exit();
			                    // echo $msg;
			                } else {
			                    $pictureName = uniqid(); // give profile pic a unique name
			                    $pictureName .= '.' . $pictureExtension;
			                    // $pictureName = time() . '_' . $picture;
			                    $target = 'images/' . $pictureName;
			                    // echo $target;

			                    $sql = "UPDATE `evaluator_list` SET `firstname`='$firstname',`lastname`='$lastname',`password`='$password',`token`='',`picture`='$target' WHERE email = '$email'";
			                    // mysqli_query($con, $sql);
			                    //     move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $target);
			                    if(mysqli_query($con, $sql)){
			                        if(move_uploaded_file($_FILES["picture"]['tmp_name'], $target)) {
			                            //unlink('../' . $deleteOldpicture); //if new profile pic is save to the directory then delete the old pic
			                            // if ($deleteOldpicture != 'assets/picturetures/female.png' && $deleteOldpicture != 'assets/picturetures/male.png') {
			                            //     unlink('../' . $deleteOldpicture); //delete developer profile pic
			                            // }
			                            $msg = 'you are now set';
			                            $cssClass = 'alert-success';
			                            header("location: index.php?page=edit&msg=$msg&cssClass=$cssClass");
			                            exit();
			                        }
			                    }
			                }
						} else {
							$sql = mysqli_query($con, "UPDATE `evaluator_list` SET `firstname`='$firstname',`lastname`='$lastname',`password`='$password',`token`='' WHERE email = '$email'");
							if ($sql) {
								$msg = 'Your are all set';
								$cssClass = 'alert-success';
								header("location: index.php?msg=$msg&cssClass=$cssClass");
								exit();
							}
						}
					}
				}
			}
		
	                    
		}
	}

	// user login
	if (@$_GET['operation'] == 'user_login') {
		if (isset($_POST['userLoginSubmit'])) {
			// echo 'workingdfdf';
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			// echo $email;
			// echo "<br>";
			// echo $password;

			if (empty($email)) {
				echo "Please enter you email";
			} else {
				if (empty($password)) {
					echo "Please enter your password";
				} else {
					// $password = md5($password);
					$sql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE email = '$email' AND token = '$password'");
					if (mysqli_num_rows($sql) >= 1) {
						// session_start();
						$data = mysqli_fetch_assoc($sql);
						$_SESSION['email'] = $data['email'];
						$_SESSION['lastname'] = $data['lastname'];
						$_SESSION['firstname'] = $data['firstname'];
						$_SESSION['id'] = $data['id'];

						echo 1;
						exit();
					} else {
						$password = md5($password);
						$sql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE email = '$email' AND password = '$password'");
						if (mysqli_num_rows($sql) > 0) {
							// session_start();
							$data = mysqli_fetch_assoc($sql);
							$_SESSION['email'] = $data['email'];
							$_SESSION['lastname'] = $data['lastname'];
							$_SESSION['firstname'] = $data['firstname'];
							$_SESSION['id'] = $data['id'];
							$_SESSION['password'] = $data['password'];

							echo 2;
						} else {
							echo "Wrong email and or Password";
						}
					}
				} 
			}
		}
	}

	// user first time login
	if (@$_GET['operation'] == 'user_first_time') {
		if (isset($_POST['userFirstTimeSubmit'])) {
			$email = $_SESSION['email'];
			$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
			// $email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
			// $picture = $_FILES['picture'];

			// echo $firstname; echo '<br>';
			// echo $lastname; echo '<br>';
			// // echo $email; echo '<br>';
			// echo $password; echo '<br>';
			// echo $confirmPassword; echo '<br>';
			// // echo $firstname; echo '<br>';
			// print_r($picture);

			if (empty($password)) {
				$msg = 'please enter password';
				$cssClass = 'alert-danger';
				header("location: user_first_login.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				if (strlen($password) < 6) {
					$msg = 'Your password cannot be less than 6 characters long';
					$cssClass = 'alert-danger';
					header("location: user_first_login.php?msg=$msg&cssClass=$cssClass");
					exit();
				} else {
					if ($password != $confirmPassword) {
						$msg = 'Your passwords do not match';
						$cssClass = 'alert-danger';
						header("location: user_first_login.php?msg=$msg&cssClass=$cssClass");
						exit();
					} else {
						$password = md5($password);
						if (isset($_FILES['picture'])) {
							$picture = $_FILES["picture"]['name'];
			                $pictureSize = $_FILES["picture"]['size'];
			                $tmpName = $_FILES["picture"]['tmp_name'];

			                // create extension array for accepted file format
			                $pictureValidExtension = ['jpg', 'jpeg', 'png'];
			                $pictureExtension = explode('.', $picture);
			                $pictureExtension = strtolower(end($pictureExtension));

			                // check to see if selected is in the accepted file format extension array
			                if(!in_array($pictureExtension, $pictureValidExtension)) {
			                    // echo "<script> alert('Unsupported File Format'); <scritp>";
			                    $msg = 'Unsupported File Format. please try again';
			                    $cssClass = 'alert-danger';
			                    header("location: user_first_login.php?page=edit&msg=$msg&cssClass=$cssClass");
			                    exit();
			                    // echo $msg;
			                } else if($pictureSize > 3000000){ // check if profile pic is larger than 3mb
			                    $msg = 'Image Size Is Too Large. please try again';
			                    $cssClass = 'alert-danger';
			                    header("location: user_first_login.php?page=edit&msg=$msg&cssClass=$cssClass");
			                    exit();
			                    // echo $msg;
			                } else {
			                    $pictureName = uniqid(); // give profile pic a unique name
			                    $pictureName .= '.' . $pictureExtension;
			                    // $pictureName = time() . '_' . $picture;
			                    $target = 'images/' . $pictureName;
			                    // echo $target;

			                    $sql = "UPDATE `employee_list` SET `firstname`='$firstname',`lastname`='$lastname',`password`='$password',`token`='',`picture`='$target' WHERE email = '$email'";
			                    // mysqli_query($con, $sql);
			                    //     move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $target);
			                    if(mysqli_query($con, $sql)){
			                        if(move_uploaded_file($_FILES["picture"]['tmp_name'], $target)) {
			                            //unlink('../' . $deleteOldpicture); //if new profile pic is save to the directory then delete the old pic
			                            // if ($deleteOldpicture != 'assets/picturetures/female.png' && $deleteOldpicture != 'assets/picturetures/male.png') {
			                            //     unlink('../' . $deleteOldpicture); //delete developer profile pic
			                            // }
			                            $msg = 'you are now set';
			                            $cssClass = 'alert-success';
			                            header("location: welcome.php?page=edit&msg=$msg&cssClass=$cssClass");
			                            exit();
			                        }
			                    }
			                }
						} else {
							$sql = mysqli_query($con, "UPDATE `employee_list` SET `firstname`='$firstname',`lastname`='$lastname',`password`='$password',`token`='' WHERE email = '$email'");
							if ($sql) {
								$msg = 'Your are all set';
								$cssClass = 'alert-success';
								header("location: welcome.php?msg=$msg&cssClass=$cssClass");
								exit();
							}
						}
					}
				}
			}
		
	                    
		}
	}

	// user update task on progess
	if (@$_GET['operation'] == 'progress_task') {
		if (@$_GET['id']) {
			$id = $_GET['id'];

			$sql = mysqli_query($con, "UPDATE `task_list` SET `status`='1' WHERE `id` = '$id'");
			if ($sql) {
				$msg = 'Task updated successfully';
				$cssClass = 'alert-success';
				header("location: welcome.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to update task';
				$cssClass = 'alert-danger';
				header("location: welcome.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// user update task completed
	if (@$_GET['operation'] == 'completed_task') {
		if (@$_GET['id']) {
			$id = $_GET['id'];

			$sql = mysqli_query($con, "UPDATE `task_list` SET `status`='2' WHERE `id` = '$id'");
			if ($sql) {
				$msg = 'Task updated successfully';
				$cssClass = 'alert-success';
				header("location: welcome.php?msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Unable to update task';
				$cssClass = 'alert-danger';
				header("location: welcome.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// forget password
	if (@$_GET['operation'] == 'code_handler') {
		if (isset($_POST['submit'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$code = mysqli_real_escape_string($con, $_POST['code']);
			// echo $email;
			$sql = mysqli_query($con, "SELECT * FROM `forget_password` WHERE email = '$email' AND code = '$code'");
			if (mysqli_num_rows($sql)) {
				$msg = 'Create a new password';
				$cssClass = 'alert-success';
				header("location: forgot_password.php?page=create_password&msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Incorrect varification code';
				$cssClass = 'alert-danger';
				header("location: forgot_password.php?page=verification_code&msg=$msg&cssClass=$cssClass");
				exit();
			}
		} else {
			$msg = 'Something went wrong';
			$cssClass = 'alert-danger';
			header("location: forgot_password.php?page=verification_code&email=$email&msg=$msg&cssClass=$cssClass");
			exit();
		}
	}

	// admin reset password create new password
	if (@$_GET['operation'] == 'new_password_handler') {
		if (isset($_POST['submit'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

			// echo $password;
			// echo "<br>";
			// echo $confirmPassword;

			if (empty($password)) {
				$msg = 'Your password cannot be less than 6 characters long';
				$cssClass = 'alert-danger';
				header("location: forgot_password.php?page=create_password&msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				if ($password == $confirmPassword) {
					$password = md5($password);
					$sql = mysqli_query($con, "UPDATE `evaluator_list` SET `password` = '$password' WHERE `email` = '$email'");
					if ($sql) {
						$sql = mysqli_query($con, "DELETE FROM `forget_password` WHERE email = '$email'");
						$sql = mysqli_query($con, "SELECT * FROM `evaluator_list` WHERE email = '$email'");
						$data = mysqli_fetch_assoc($sql);
						$_SESSION['email'] = $data['email'];
						$_SESSION['firstname'] = $data['firstname'];
						$_SESSION['lastname'] = $data['lastname'];
						$_SESSION['id'] = $data['id'];
						// $_SESSION['email'] = $data['email'];

						$msg = 'You have successfuly reset your password';
						$cssClass = 'alert-success';
						header("location: welcome.php?msg=$msg&cssClass=$cssClass");
						exit();
					} else {
						$msg = 'Unable to reset password';
						$cssClass = 'alert-danger';
						header("location: forgot_password.php?page=create_password&msg=$msg&cssClass=$cssClass");
						exit();
					}
				} else {
					$msg = 'Your passwords do not match';
					$cssClass = 'alert-danger';
					header("location: forgot_password.php?page=create_password&msg=$msg&cssClass=$cssClass");
					exit();
				}
			}

		}
	}

	// update admin profile
	if (@$_GET['operation'] == 'update_profile') {
		if (isset($_POST['updateProfileSubmit'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
			// $picture = mysqli_real_escape_string($con, $_POST['picture']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$sessionEmail = $_SESSION['email'];
			$password = md5($password);
			// echo $email;
			// echo "<br>";
			// echo $firstname;echo "<br>";
			// echo $lastname;echo "<br>";
			// echo $password;echo "<br>";
			$sql = mysqli_query($con, "SELECT * FROM `evaluator_list` WHERE email = '$sessionEmail' AND password = '$password'");
			if (mysqli_num_rows($sql) > 0) {
				if (isset($_FILES['picture'])) {
					$picture = $_FILES["picture"]['name'];
	                $pictureSize = $_FILES["picture"]['size'];
	                $tmpName = $_FILES["picture"]['tmp_name'];

	                // create extension array for accepted file format
	                $pictureValidExtension = ['jpg', 'jpeg', 'png'];
	                $pictureExtension = explode('.', $picture);
	                $pictureExtension = strtolower(end($pictureExtension));

	                // check to see if selected is in the accepted file format extension array
	                if(!in_array($pictureExtension, $pictureValidExtension)) {
	                    // echo "<script> alert('Unsupported File Format'); <scritp>";
	                    $msg = 'Unsupported File Format. please try again';
	                    $cssClass = 'alert-danger';
	                    header("location: profile.php?msg=$msg&cssClass=$cssClass");
	                    exit();
	                    // echo $msg;
	                } else if($pictureSize > 3000000){ // check if profile pic is larger than 3mb
	                    $msg = 'Image Size Is Too Large. please try again';
	                    $cssClass = 'alert-danger';
	                    header("location: profile.php?msg=$msg&cssClass=$cssClass");
	                    exit();
	                    // echo $msg;
	                } else {
	                    $pictureName = uniqid(); // give profile pic a unique name
	                    $pictureName .= '.' . $pictureExtension;
	                    // $pictureName = time() . '_' . $picture;
	                    $target = 'images/' . $pictureName;
	                    // echo $target;

	                    $sql = "UPDATE `evaluator_list` SET `firstname`='$firstname',`lastname`='$lastname',`picture`='$target' WHERE `email` = '$email'";
	                    // mysqli_query($con, $sql);
	                    //     move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $target);
	                    if(mysqli_query($con, $sql)){
	                        if(move_uploaded_file($_FILES["picture"]['tmp_name'], $target)) {
	                            //unlink('../' . $deleteOldpicture); //if new profile pic is save to the directory then delete the old pic
	                            // if ($deleteOldpicture != 'assets/picturetures/female.png' && $deleteOldpicture != 'assets/picturetures/male.png') {
	                            //     unlink('../' . $deleteOldpicture); //delete developer profile pic
	                            // }
	                            $_SESSION['email'] = $email;
	                            $_SESSION['firstname'] = $firstname;
	                            $_SESSION['lastname'] = $lastname;
	                            $msg = 'Profile updated successfully';
	                            $cssClass = 'alert-success';
	                            header("location: profile.php?msg=$msg&cssClass=$cssClass");
	                            exit();
	                        }
	                    }
	                }
				} else {
					$sql = mysqli_query($con, "UPDATE `evaluator_list` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email' WHERE `email` = '$email'");
					if ($sql) {
						$msg = 'Profile updated successfully';
						$cssClass = 'alert-success';
						header("location: profile.php?msg=$msg&cssClass=$cssClass");
						exit();
					}
				}
			} else {
				$msg = 'Incorrect password';
				$cssClass = 'alert-danger';
				header("location: profile.php?msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// update user profile
	if (@$_GET['operation'] == 'user_update_profile') {
		if (isset($_POST['userUpdateProfileSubmit'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
			$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
			// $picture = mysqli_real_escape_string($con, $_POST['picture']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$sessionEmail = $_SESSION['email'];
			$password = md5($password);
			// echo $email;
			// echo "<br>";
			// echo $firstname;echo "<br>";
			// echo $lastname;echo "<br>";
			// echo $password;echo "<br>";
			$sql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE email = '$sessionEmail' AND password = '$password'");
			if (mysqli_num_rows($sql) > 0) {
				if (isset($_FILES['picture'])) {
					$picture = $_FILES["picture"]['name'];
	                $pictureSize = $_FILES["picture"]['size'];
	                $tmpName = $_FILES["picture"]['tmp_name'];

	                // create extension array for accepted file format
	                $pictureValidExtension = ['jpg', 'jpeg', 'png'];
	                $pictureExtension = explode('.', $picture);
	                $pictureExtension = strtolower(end($pictureExtension));

	                // check to see if selected is in the accepted file format extension array
	                if(!in_array($pictureExtension, $pictureValidExtension)) {
	                    // echo "<script> alert('Unsupported File Format'); <scritp>";
	                    $msg = 'Unsupported File Format. please try again';
	                    $cssClass = 'alert-danger';
	                    header("location: welcome.php?page=profile&msg=$msg&cssClass=$cssClass");
	                    exit();
	                    // echo $msg;
	                } else if($pictureSize > 3000000){ // check if profile pic is larger than 3mb
	                    $msg = 'Image Size Is Too Large. please try again';
	                    $cssClass = 'alert-danger';
	                    header("location: welcome.php?page=profile&msg=$msg&cssClass=$cssClass");
	                    exit();
	                    // echo $msg;
	                } else {
	                    $pictureName = uniqid(); // give profile pic a unique name
	                    $pictureName .= '.' . $pictureExtension;
	                    // $pictureName = time() . '_' . $picture;
	                    $target = 'images/' . $pictureName;
	                    // echo $target;

	                    $sql = "UPDATE `employee_list` SET `firstname`='$firstname',`lastname`='$lastname',`picture`='$target' WHERE `email` = '$email'";
	                    // mysqli_query($con, $sql);
	                    //     move_uploaded_file($_FILES['picture']['tmp_name'], '../' . $target);
	                    if(mysqli_query($con, $sql)){
	                        if(move_uploaded_file($_FILES["picture"]['tmp_name'], $target)) {
	                            //unlink('../' . $deleteOldpicture); //if new profile pic is save to the directory then delete the old pic
	                            // if ($deleteOldpicture != 'assets/picturetures/female.png' && $deleteOldpicture != 'assets/picturetures/male.png') {
	                            //     unlink('../' . $deleteOldpicture); //delete developer profile pic
	                            // }
	                            $_SESSION['email'] = $email;
	                            $_SESSION['firstname'] = $firstname;
	                            $_SESSION['lastname'] = $lastname;
	                            $msg = 'Profile updated successfully';
	                            $cssClass = 'alert-success';
	                            header("location: welcome.php?page=profile&msg=$msg&cssClass=$cssClass");
	                            exit();
	                        }
	                    }
	                }
				} else {
					$sql = mysqli_query($con, "UPDATE `employee_list` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email' WHERE `email` = '$email'");
					if ($sql) {
						$msg = 'Profile updated successfully';
						$cssClass = 'alert-success';
						header("location: welcome.php?page=profile&msg=$msg&cssClass=$cssClass");
						exit();
					}
				}
			} else {
				$msg = 'Incorrect password';
				$cssClass = 'alert-danger';
				header("location: welcome.php?page=profile&msg=$msg&cssClass=$cssClass");
				exit();
			}
		}
	}

	// user forgot password
	if (@$_GET['operation'] == 'user_forgot_password') { ?>
		<!DOCTYPE html>
		<html lang="en" class="h-100">
		    <head>
		        <meta charset="utf-8">
		        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		        <meta name="viewport" content="width=device-width, initial-scale=1">
		        
		        <!-- PAGE TITLE HERE -->
		        <title>User Forgot Password</title>
		        
		        <!-- FAVICONS ICON -->
		        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
		        <link href="css/style.css" rel="stylesheet">
		    </head>
		    <body class="vh-100">
		        <div class="authincation h-100">
		            <div class="container h-100">
		                <div class="row justify-content-center h-100 align-items-center">
		                    <div class="col-md-6">
		                        <div class="authincation-content">
		                            <div class="row no-gutters">
		                                <div class="col-xl-12">
		                                    <div class="auth-form">
		                                        <li>
		                                            <?php if (@$_GET['msg']) {
		                                            if (@$_GET['cssClass']) { ?>
		                                            <div class="alert <?= $_GET['cssClass']; ?> text-center fs-18 fw-bold text-dark" id="msgAlert" role="alert">
		                                                <?= $_GET['msg']; ?>
		                                                <!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
		                                            </div>
		                                            <?php }
		                                            } ?>
		                                        </li>
		                                        <div class="text-center mb-3">
		                                            <!-- <a href="index.html"><img src="images/logo-full.png" alt=""></a><h3 class="text-center">Admin Forgot Password</h3> -->
		                                        </div>
		                                            <h2 class="text-center mb-4">Employee Forgot Password</h2>
		                                            <h6 class="text-center">Enter email to reset password</h6>
		                                            <!-- <form action="phpmailer/index.php?operation=forgot_password" method="post"> -->
		                                            <form action="phpmailer/index.php?operation=user_forgot_password_verif_code" method="post">
		                                                <div class="mb-3">
		                                                    <label><strong>Email</strong></label>
		                                                    <input type="email" name="email" id="email" class="form-control border border-primary border-2" placeholder="hello@example.com">
		                                                </div>
		                                                <div class="row d-flex justify-content-between mt-4 mb-2">
		                                                    <div class="mb-3">
		                                                        <a href="login.php" class="h4">Log In</a>
		                                                    </div>
		                                                </div>
		                                                <div class="text-center">
		                                                    <button type="submit" name="submit" class="btn btn-primary btn-block">SUBMIT</button>
		                                                </div>
		                                            </form>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <!--**********************************
		        Scripts
		        ***********************************-->
		        <!-- Required vendors -->
		        <script src="vendor/global/global.min.js"></script>
		        <script src="js/custom.min.js"></script>
		        <script src="js/dlabnav-init.js"></script>
		        <!-- <script src="js/styleSwitcher.js"></script> -->
		    </body>
		</html>
	<?php }

	// user verification code
	if (@$_GET['operation'] == 'user_verification_code') {
        if (isset($_GET['email'])) {
            $email = $_GET['email']; ?>
            <!DOCTYPE html>
			<html lang="en" class="h-100">
			    <head>
			        <meta charset="utf-8">
			        <meta http-equiv="X-UA-Compatible" content="IE=edge">
			        <meta name="viewport" content="width=device-width, initial-scale=1">
			        
			        <!-- PAGE TITLE HERE -->
			        <title>Admin Dashboard</title>
			        
			        <!-- FAVICONS ICON -->
			        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
			        <link href="css/style.css" rel="stylesheet">
			    </head>
			    <body class="vh-100">
			        <div class="authincation h-100">
			            <div class="container h-100">
			                <div class="row justify-content-center h-100 align-items-center">
			                    <div class="col-md-6">
			                        <div class="authincation-content">
			                            <div class="row no-gutters">
			                                <div class="col-xl-12">
			                                    <div class="auth-form">
			                                        <li>
			                                            <?php if (@$_GET['msg']) {
			                                            if (@$_GET['cssClass']) { ?>
			                                            <div class="alert <?= $_GET['cssClass']; ?> text-center fs-18 fw-bold text-dark" id="msgAlert" role="alert">
			                                                <?= $_GET['msg']; ?>
			                                                <!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
			                                            </div>
			                                            <?php }
			                                            } ?>
			                                        </li>
			                                        <div class="text-center mb-3">
			                                            <!-- <a href="index.html"><img src="images/logo-full.png" alt=""></a><h3 class="text-center">Admin Forgot Password</h3> -->
			                                        </div>
			                                                <h2 class="text-center mb-4">Employee Forgot Password</h2>
			                                                <h6 class="text-center">Enter Verification code to reset password</h6>
			                                                <form action="operations.php?operation=user_code_handler" method="post">
			                                                    <div class="mb-3">
			                                                        <label for="code"><strong>Verification Code</strong></label>
			                                                        <input type="text" name="code" id="code" class="form-control border border-primary border-2" placeholder="Enter Verification code">
			                                                        <input type="hidden" name="email" id="email" value="<?= $email; ?>">
			                                                    </div>
			                                                    <div class="row d-flex justify-content-between mt-4 mb-2">
			                                                        <div class="mb-3">
			                                                            <a href="login.php" class="h4">Log In</a>
			                                                        </div>
			                                                    </div>
			                                                    <div class="text-center">
			                                                        <button type="submit" name="submit" class="btn btn-primary btn-block">SUBMIT</button>
			                                                    </div>
			                                                </form>
			                                        <?php }
			                                        ?>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <!--**********************************
			        Scripts
			        ***********************************-->
			        <!-- Required vendors -->
			        <script src="vendor/global/global.min.js"></script>
			        <script src="js/custom.min.js"></script>
			        <script src="js/dlabnav-init.js"></script>
			        <!-- <script src="js/styleSwitcher.js"></script> -->
			    </body>
			</html>
    <?php }

    // user forget verification code handler
	if (@$_GET['operation'] == 'user_code_handler') {
		if (isset($_POST['submit'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$code = mysqli_real_escape_string($con, $_POST['code']);
			// echo $email;
			$sql = mysqli_query($con, "SELECT * FROM `forget_password` WHERE email = '$email' AND code = '$code'");
			if (mysqli_num_rows($sql)) {
				$msg = 'Create a new password';
				$cssClass = 'alert-success';
				header("location: operations.php?operation=user_create_password&email=$email&msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				$msg = 'Incorrect varification code';
				$cssClass = 'alert-danger';
				header("location: operations.php?operation=user_verification_code&msg=$msg&cssClass=$cssClass");
				exit();
			}
		} else {
			$msg = 'Something went wrong';
			$cssClass = 'alert-danger';
			header("location: operations.php?operation=user_verification_code&email=$email&msg=$msg&cssClass=$cssClass");
			exit();
		}
	}

	// user create new password
	if (@$_GET['operation'] == 'user_create_password') {
		if (@$_GET['email']) {
			$email = $_GET['email']; ?>

			<!DOCTYPE html>
			<html lang="en" class="h-100">
			    <head>
			        <meta charset="utf-8">
			        <meta http-equiv="X-UA-Compatible" content="IE=edge">
			        <meta name="viewport" content="width=device-width, initial-scale=1">
			        
			        <!-- PAGE TITLE HERE -->
			        <title>Admin Dashboard</title>
			        
			        <!-- FAVICONS ICON -->
			        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
			        <link href="css/style.css" rel="stylesheet">
			    </head>
			    <body class="vh-100">
			        <div class="authincation h-100">
			            <div class="container h-100">
			                <div class="row justify-content-center h-100 align-items-center">
			                    <div class="col-md-6">
			                        <div class="authincation-content">
			                            <div class="row no-gutters">
			                                <div class="col-xl-12">
			                                    <div class="auth-form">
			                                        <li>
			                                            <?php if (@$_GET['msg']) {
			                                            if (@$_GET['cssClass']) { ?>
			                                            <div class="alert <?= $_GET['cssClass']; ?> text-center fs-18 fw-bold text-dark" id="msgAlert" role="alert">
			                                                <?= $_GET['msg']; ?>
			                                                <!-- <button type="button" class="btn btn-primary" id="msgAlert">Show live alert</button> -->
			                                            </div>
			                                            <?php }
			                                            } ?>
			                                        </li>
			                                        <div class="text-center mb-3">
			                                            <!-- <a href="index.html"><img src="images/logo-full.png" alt=""></a><h3 class="text-center">Admin Forgot Password</h3> -->
			                                        </div>
                                                    <h2 class="text-center mb-4">Employee Reset Password</h2>
                                                    <h6 class="text-center">Create a new password</h6>
                                                    <form action="operations.php?operation=user_new_password_handler" method="post">
                                                        <div class="mb-3">
                                                            <label for="password"><strong>New Password</strong></label>
                                                            <input type="password" name="password" id="password" class="form-control border border-primary border-2" placeholder="Create new password">
                                                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="confirmPassword" class="form-label"><strong>Re Enter Password</strong></label>
                                                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control border border-primary border-2" placeholder="Re enter password">
                                                        </div>
                                                        <div class="text-center">
                                                            <button type="submit" name="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                                        </div>
                                                    </form>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>
			        <!--**********************************
			        Scripts
			        ***********************************-->
			        <!-- Required vendors -->
			        <script src="vendor/global/global.min.js"></script>
			        <script src="js/custom.min.js"></script>
			        <script src="js/dlabnav-init.js"></script>
			        <!-- <script src="js/styleSwitcher.js"></script> -->
			    </body>
			</html>
		<?php }
	}

	// user reset password create new password
	if (@$_GET['operation'] == 'user_new_password_handler') {
		if (isset($_POST['submit'])) {
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

			// echo $password;
			// echo "<br>";
			// echo $confirmPassword;

			if (empty($password)) {
				$msg = 'Your password cannot be less than 6 characters long';
				$cssClass = 'alert-danger';
				header("location: operations.php?operation=user_create_password&msg=$msg&cssClass=$cssClass");
				exit();
			} else {
				if ($password == $confirmPassword) {
					$password = md5($password);
					$sql = mysqli_query($con, "UPDATE `employee_list` SET `password` = '$password' WHERE `email` = '$email'");
					if ($sql) {
						$sql = mysqli_query($con, "DELETE FROM `forget_password` WHERE email = '$email'");
						$sql = mysqli_query($con, "SELECT * FROM `employee_list` WHERE email = '$email'");
						$data = mysqli_fetch_assoc($sql);
						$_SESSION['email'] = $data['email'];
						$_SESSION['firstname'] = $data['firstname'];
						$_SESSION['lastname'] = $data['lastname'];
						$_SESSION['id'] = $data['id'];
						// $_SESSION['email'] = $data['email'];

						$msg = 'You have successfuly reset your password';
						$cssClass = 'alert-success';
						header("location: welcome.php?msg=$msg&cssClass=$cssClass");
						exit();
					} else {
						$msg = 'Unable to reset password';
						$cssClass = 'alert-danger';
						header("location: operations.php?operation=user_create_password&msg=$msg&cssClass=$cssClass");
						exit();
					}
				} else {
					$msg = 'Your passwords do not match';
					$cssClass = 'alert-danger';
					header("location: operations.php?operation=user_create_password&msg=$msg&cssClass=$cssClass");
					exit();
				}
			}
		}
	}