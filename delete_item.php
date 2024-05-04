<?php
include 'connection.php';
$image=Encryption('image');
$id=Encryption('itemId');
deleteData('items','تعذر الحذف',"items_id=$id");
DeletFile($image);