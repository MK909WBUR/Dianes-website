<?php
$cookie_name = "formSubmitted";
$cookie_value = "thanks";
setcookie($cookie_name, $cookie_value, time() + (86400 * 3), "/");

if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $visitor_email = $_POST['email'];
  $message = $_POST['message'];

//Validate first
if(empty($fname)||empty($visitor_email)||empty($lname)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'micah@dianecover.com';//<== update the email address DONE
$email_subject = "New Form submission by $fname $lname";
$email_body = "You have received a new message from the user $fname.\n Here is the message:\n $message";

$to = "micah.klein04@gmail.com";//<== update the email address
//$to = "micah.klein04@gmail.com,coverwachs@gmai.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);

//done. redirect to thank-you page.
header('Location: contact.html');


// Function to validate against any email injection attempts
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
<html>
<body>

Welcome <b><?php echo $fname; ?></b><br>
Your email address is: <b><?php echo $_POST["email"]; ?></b>

</body>
</html>