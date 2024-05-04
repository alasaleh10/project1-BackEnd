<?php
include 'connection.php';

$name=GetEncryption('name');

getAllData('items','لايوجد منتجات',"items_name Like '%$name%'");