<?php
include 'connection.php';
$id=Encryption('id');
$name=Encryption('name');
$description=Encryption('description');
$price=Encryption('price');



$data=array(
    'items_name'=>$name,
    'items_price'=>$price,
    'items_des'=>$description
);
updateData('items','فشلة العملية',$data,"items_id=$id");