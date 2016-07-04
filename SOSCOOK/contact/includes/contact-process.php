<?php
/*
Credits: Bit Repository
URL: http://www.bitrepository.com/
*/

include dirname(dirname(__FILE__)).'/config.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'functions.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$message = stripslashes($_POST['message']);

$error = '';

// Check name

if(!$name)
{
$error .= 'Please enter your name.<br />';
}

// Check email

if(!$email)
{
$error .= 'Please enter an e-mail address.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Please enter a valid e-mail address.<br />';
}

// Check message (length)

if(!$message || strlen($message) < 15)
{
$error .= "Please enter your message. It should have at least 15 characters.<br />";
}

if(!$error)
{
	$mail = @mail(WEBMASTER_EMAIL, "You have a new message.", $message,
		 "From: ".$name." <".$email.">\r\n"
		."Reply-To: ".$email."\r\n"
		."X-Mailer: PHP/" . phpversion());


	if($mail)
	{
	echo 'OK';
	}
	
	}
	else
	{
	echo '<div class="notification_error">'.$error.'</div>';
	}

}
?>