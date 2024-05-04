<?php
include '../connection.php';
$email=Encryption('email');
$password=Encryption('password');


$count=getData('users','',"user_email=?",array($email),false);

if($count>0)
{
    sendFailureResponse('هذا الحساب موجود مسبقا');

   
}
else
{
    $data=array(
        'user_email'=>$email,
        'user_password'=>$password

    );
 insertData('users','',$data,false);
 $lastInsertedId = $con->lastInsertId(); 
getData('users','',"user_id=?",array($lastInsertedId));


}
