<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

    

//Include required PHPMailer files
    require_once '../dbConnect.php';
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;


    // forget password
    if (@$_GET['operation'] == 'forgot_password') {
        if (isset($_POST['submit'])) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            // echo $email;
            if (empty($email)) {
                $msg = 'please enter your email';
                $cssClass = 'alert-danger';
                header("location: ../forgot_password.php?msg=$msg&cssClass=$cssClass");
                exit();
            } else {
                $sql = mysqli_query($con, "SELECT `email` FROM `evaluator_list` WHERE `email` = '$email'");
                if (mysqli_num_rows($sql) < 1) {
                    $msg = 'This email is not registered';
                    $cssClass = 'alert-danger';
                    header("location: ../forgot_password.php?msg=$msg&cssClass=$cssClass");
                    exit();
                } else {
                    $token = rand(000, 999).mt_rand(000, 999);
                    echo $token;
                    $subject = 'Verification Code From TaTU Employee Appraisal';
                    $body = "<p>You request to reset your account password and here your verification code</p>
                        <p style='font-weight: bold; color: red;'>".$token."</p>";

                    $sql = mysqli_query($con, "SELECT * FROM forget_password WHERE email = '$email'");
                    if (mysqli_num_rows($sql) > 0) {
                        $sql2 = mysqli_query($con, "UPDATE `forget_password` SET `code` = '$token' WHERE `email` = '$email'");
                    } else {
                        $sql2 = mysqli_query($con, "INSERT INTO `forget_password`( `email`, `code`) VALUES ('$email','$token')");
                    }
                    if ($sql2) {
                        //Create instance of PHPMailer
                            $mail = new PHPMailer();
                        //Set mailer to use smtp
                            $mail->isSMTP();
                        //Define smtp host
                            $mail->Host = "smtp.gmail.com";
                        //Enable smtp authentication
                            $mail->SMTPAuth = true;
                        //Set smtp encryption type (ssl/tls)
                            $mail->SMTPSecure = "tls";
                        //Port to connect smtp
                            $mail->Port = "587";
                        //Set gmail username
                            $mail->Username = "marssoftwares1@gmail.com";
                        //Set gmail password
                            $mail->Password = "sdlbvsolsmepcvpe";
                        //Email subject
                            $mail->Subject = $subject;
                        //Set sender email
                            $mail->setFrom('marssoftwares1@gmail.com');
                        //Enable HTML
                            $mail->isHTML(true);
                        //Attachment
                            //$mail->addAttachment('img/attachment.png');
                        //Email body
                            $mail->Body = $body;
                        //Add recipient
                            $mail->addAddress($email);
                        //Finally send email
                            if ( $mail->send() ) {
                                $msg = 'Verification Code has been sent to your email address';
                                $cssClass = 'alert-success';
                                header("location: ../forgot_password.php?page=verification_code&email=$email&msg=$msg&cssClass=$cssClass");
                                exit();
                            }else{
                                // echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
                                $msg = 'Unable to generate verification code. please try again later';
                                $cssClass = 'alert-danger';
                                header("location: ../forgot_password.php?email=$email&msg=$msg&cssClass=$cssClass");
                                exit();
                            }
                        //Closing smtp connection
                            $mail->smtpClose();
                    }
                }
            }
        }
    }

    //user forget password
    if (@$_GET['operation'] == 'user_forgot_password_verif_code') {
        if (isset($_POST['submit'])) {
            $email = mysqli_real_escape_string($con, $_POST['email']);
            // echo $email;
            if (empty($email)) {
                $msg = 'please enter your email';
                $cssClass = 'alert-danger';
                header("location: ../operations.php?operation=user_forgot_password&msg=$msg&cssClass=$cssClass");
                exit();
            } else {
                $sql = mysqli_query($con, "SELECT `email` FROM `employee_list` WHERE `email` = '$email'");
                if (mysqli_num_rows($sql) < 1) {
                    $msg = 'This email is not registered';
                    $cssClass = 'alert-danger';
                    header("location: ../operations.php?operation=user_forgot_password&msg=$msg&cssClass=$cssClass");
                    exit();
                } else {
                    $token = rand(111, 999).mt_rand(111, 999);
                    echo $token;
                    $subject = 'Verification Code From TaTU Employee Appraisal';
                    $body = "<p>You request to reset your account password and here your verification code</p>
                        <p style='font-weight: bold; color: red;'>".$token."</p>";

                    $sql = mysqli_query($con, "SELECT * FROM forget_password WHERE email = '$email'");
                    if (mysqli_num_rows($sql) > 0) {
                        $sql2 = mysqli_query($con, "UPDATE `forget_password` SET `code` = '$token' WHERE `email` = '$email'");
                    } else {
                        $sql2 = mysqli_query($con, "INSERT INTO `forget_password`( `email`, `code`) VALUES ('$email','$token')");
                    }
                    if ($sql2) {
                        //Create instance of PHPMailer
                            $mail = new PHPMailer();
                        //Set mailer to use smtp
                            $mail->isSMTP();
                        //Define smtp host
                            $mail->Host = "smtp.gmail.com";
                        //Enable smtp authentication
                            $mail->SMTPAuth = true;
                        //Set smtp encryption type (ssl/tls)
                            $mail->SMTPSecure = "tls";
                        //Port to connect smtp
                            $mail->Port = "587";
                        //Set gmail username
                            $mail->Username = "marssoftwares1@gmail.com";
                        //Set gmail password
                            $mail->Password = "sdlbvsolsmepcvpe";
                        //Email subject
                            $mail->Subject = $subject;
                        //Set sender email
                            $mail->setFrom('marssoftwares1@gmail.com');
                        //Enable HTML
                            $mail->isHTML(true);
                        //Attachment
                            //$mail->addAttachment('img/attachment.png');
                        //Email body
                            $mail->Body = $body;
                        //Add recipient
                            $mail->addAddress($email);
                        //Finally send email
                            if ( $mail->send() ) {
                                $msg = 'Verification Code has been sent to your email address';
                                $cssClass = 'alert-success';
                                header("location: ../operations.php?operation=user_verification_code&email=$email&msg=$msg&cssClass=$cssClass");
                                exit();
                            }else{
                                // echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
                                $msg = 'Unable to generate verification code. please try again later';
                                $cssClass = 'alert-danger';
                                header("location: ../operations.php?operation=user_forgot_password&email=$email&msg=$msg&cssClass=$cssClass");
                                exit();
                            }
                        //Closing smtp connection
                            $mail->smtpClose();
                    }
                }
            }
        }
    }


// //Create instance of PHPMailer
// 	$mail = new PHPMailer();
// //Set mailer to use smtp
// 	$mail->isSMTP();
// //Define smtp host
// 	$mail->Host = "smtp.gmail.com";
// //Enable smtp authentication
// 	$mail->SMTPAuth = true;
// //Set smtp encryption type (ssl/tls)
// 	$mail->SMTPSecure = "tls";
// //Port to connect smtp
// 	$mail->Port = "587";
// //Set gmail username
// 	$mail->Username = "Your Gmail Email Address Here";
// //Set gmail password
// 	$mail->Password = "Your Gmail Password Here";
// //Email subject
// 	$mail->Subject = "Test email using PHPMailer";
// //Set sender email
// 	$mail->setFrom('Sender Email who will send email');
// //Enable HTML
// 	$mail->isHTML(true);
// //Attachment
// 	$mail->addAttachment('img/attachment.png');
// //Email body
// 	$mail->Body = "<h1>This is HTML h1 Heading</h1></br><p>This is html paragraph</p>";
// //Add recipient
// 	$mail->addAddress('Email of the person who will receive email');
// //Finally send email
// 	if ( $mail->send() ) {
// 		echo "Email Sent..!";
// 	}else{
// 		echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
// 	}
// //Closing smtp connection
// 	$mail->smtpClose();
