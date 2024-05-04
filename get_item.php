<?php

include 'connection.php';
$itemId=GetEncryption('itemId');
getData('items','فشلة العملية',"items_id=?",array($itemId));