<?php 
/**
 * We have to put the PHPMailer namespaces at the top of the page.
*/
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
 
/*
   We have to require the config.php file to use our 
   Gmail account login details.
*/
require 'config.php'; // MAILHOST,USERNAME,PASSWORD,SEND_FROM,SEND_FROM_NAME,REPLY_TO,REPLY_TO_NAME

require 'vendor/autoload.php';

function sendMail($email, $subject, $message){
   // Creating a new PHPMailer object.
   $mail = new PHPMailer(true);
 
   // Using the SMTP protocol to send the email.
   $mail->isSMTP();
 
   /* 
      Setting the SMTPAuth property to true, so we can use 
      our Gmail login	details to send the mail.
   */	
   $mail->SMTPAuth = true;
 
   /*  
      Setting the Host property to the MAILHOST value 
      that we define in the config file.
   */	
   $mail->Host = MAILHOST;
 
   /*  Setting the Username property to the USERNAME value 
      that we define in the config file.
   */	
   $mail->Username = USERNAME;
 
   /*
      Setting the Password property to the PASSWORD value 
      that we define in the config file.
   */	
   $mail->Password = PASSWORD;
    
   /*
      By setting SMTPSecure to PHPMailer::ENCRYPTION_STARTTLS, 
      we are telling PHPMailer to use the STARTTLS encryption 
      method when connecting to the SMTP server. 
      This helps ensure that the communication between your 
      PHP application and the SMTP server is encrypted, adding a 
      layer of security to your	email sending process.
   */
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 
   // TCP port to connect with the Gmail SMTP server.
   $mail->Port = 587;
 
   /*
      Who is sending the email. Again we use the constants 
      that we define in	the config file.
    */
   $mail->setFrom(SEND_FROM, SEND_FROM_NAME);
 
   /*
      Where the mail goes. We use the $email function's 
      parameter that holds the email address that we type 
      in the email input field. 
    */
   $mail->addAddress($email);
 
   /*
      The 'addReplyTo' property specifies where the 
      recipient can reply to.
      Again we use the constants from the config file.
    */
   $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);
 
   /*
      By setting $mail->IsHTML(true), we inform PHPMailer that 
      the email message	we're constructing will include 
      HTML markup. 
      This is important when we want to send emails with 
      HTML formatting, which allow us to include things like 
      hyperlinks, images, formatting, 
      and other HTML elements in our email content.
    */
   $mail->IsHTML(true);
 
   /*
      Assigning the incoming subject to the 
      $mail->subject property. 	
    */
   $mail->Subject = $subject;
 
   /*
      Assigning the incoming message to the $mail->body property.
    */
   $mail->Body = $message;
 
   /*
      When we set $mail->AltBody, we are providing 
      a plain text alternative to the HTML version of our email. 
      This is important for compatibility with email clients 
      that may not support or display HTML content. 
      In such cases, the email client will display 
      the plain text content instead of the HTML content.
    */
   $mail->AltBody = $message;
   
   /*
      And last we send the email.
      If something goes wrong the function will return an error,
      else the function returns the string success.
      We are going to catch the returned value in the index file,
      and display it in the HTML form.
    */
   if(!$mail->send()){
      return "Email not send. Please try again";
   }else{
      return "success";
   }
}

if(!(isset($_POST['submit-button']))){
   header("Location: form.php");
}

if($_POST['name'] and $_POST['email'] and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) and $_POST['subject'] and $_POST['message']){
   echo sendMail($_POST['email'],$_POST['subject'],$_POST['message'])."<br><br>";
}else{
   echo "required field/s missing or email format is incorrect. please send again.<br><br>";
}

echo "<a href='form.php'>Send Mail</a>";



