<?php
include '../connection.php';
$email=Encryption('email');
$password=Encryption('password');
$count=getData('users','',"user_email=? AND user_password=?",array($email,$password),false);
if($count>0)
{
    getData('users','',"user_email=? AND user_password=?",array($email,$password));
}
else
{
    sendFailureResponse('البريد الإلكتروني او كلمة المرور غير صحيح');
}