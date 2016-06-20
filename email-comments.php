<?php
if(!isset($_POST['submit-e']))
{
	echo "error; form has not been submitted";
}
$name = $_POST['vis-name'];
$visitor_email = $_POST['vis-email'];
$message = $_POST['comment'];

//Validate first
if(empty($name)||empty($visitor_email))
{
    echo "Name and email are required";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Invalid email value";
    exit;
}

$email_from = 'estellahom@gmail.com';
$email_subject = "Hom Kitchen Comment";
$email_body = "You have received a new comment from $name.\n".
	"The comment is as follows:\n $message".

$to = "estellahom@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers);
header('Location: thank-you.html');


// Validate against email injection
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

?>
