<?php 
$to_email = 'gabrielciortea@gmail.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: sigfilippoberio@gmail.com';
mail($to_email,$subject,$message,$headers);
?>
