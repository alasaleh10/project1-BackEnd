<?php
include 'connection.php';
$name=Encryption('name');
$description=Encryption('des');
$price=Encryption('price');
$cat=Encryption('cat');


$file= uploadfile('file',$name);

   if($file==0)
   {
    sendFailureResponse('يجب ان تكون صورة');
   }
   else if($file==1)
   {
    sendFailureResponse( 'حجم الصورة يجب تكون اقل من 7 ميقا');
   }
   else
   {
    $data=array(
        'items_name'=>$name,
        'items_price'=>$price,
        'items_des'=>$description,
        'items_image'=>$file,
        'id_categoris'=>$cat

        
    );
    insertData('items','فشلة العملية',$data);
   }