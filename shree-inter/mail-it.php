<?php

/* Code by David McKeown - craftedbydavid.com */
/* Editable entries are bellow */

$send_to = "naveen.kp@icadengineering.com";
$send_subject = "icad";



/*Be careful when editing below this line */

$f_name = cleanupentries($_POST["name"]);
$f_company = cleanupentries($_POST["company"]);
$f_email = cleanupentries($_POST["email"]);
$f_phone = cleanupentries($_POST["phone"]);
$f_subject = cleanupentries($_POST["subject"]);
$f_message = cleanupentries($_POST["message"]);
$from_ip = $_SERVER['REMOTE_ADDR'];
$from_browser = $_SERVER['HTTP_USER_AGENT'];

function cleanupentries($entry) {
	$entry = trim($entry);
	$entry = stripslashes($entry);
	$entry = htmlspecialchars($entry);

	return $entry;
}

$message = "This email was submitted on " . date('m-d-Y') . 
"\n\nName: " . $f_name . 
"\n\nName: " . $f_company . 
"\n\nE-Mail: " . $f_email . 
"\n\nE-Mail: " . $f_phone . 
"\n\nSubject: " . $f_subject . 
"\n\nMessage: \n" . $f_message . 
"\n\n\nTechnical Details:\n" . $from_ip . "\n" . $from_browser;

$send_subject .= " - {$f_name}";

$headers = "From: " . $f_email . "\r\n" .
    "Reply-To: " . $f_email . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

if (!$f_email) {
	echo "no email";
	exit;
}else if (!$f_name){
	echo "no name";
	exit;
}else{
	if (filter_var($f_email, FILTER_VALIDATE_EMAIL)) {
		mail($send_to, $send_subject, $message, $headers);
		echo "true";
	}else{
		echo "invalid email";
		exit;
	}
}

?>