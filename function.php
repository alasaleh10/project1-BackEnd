<?php

function Encryption($requestname)
{
    return  htmlspecialchars(strip_tags($_POST[$requestname]));
}
function GetEncryption($requestname)
{
    return  htmlspecialchars(strip_tags($_GET[$requestname]));
}
function currentTime()
{
    date_default_timezone_set('Asia/Riyadh'); 

return date('Y-m-d H:i:s');
}
function getAllData($table,$message, $where = null, $values = null,$jeson=true)
{
    global $con;
  
    $data = array();
    if($where==null){
        $stmt = $con->prepare("SELECT  * FROM $table ");

    }
    else{
        $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");

    }
    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($jeson==true){
        if ($count > 0) {
            echo json_encode(array("status" => true, "data" => $data));
        } else {
            echo json_encode(array( 
                "status" => false,
                "message"=>$message
            ));
        }
        return $count;
    }
    else{
        return $count;
    //   if($count>0){
    //     return $data;
    //   }
    //   else{
    //     return $data;
    //   }
    } 
}
function getData($table, $message,$where = null, $values = null,$jeson=true)
{
    global $con;
  
    $data = array();
    $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
    $stmt->execute($values);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();
    if($jeson==true){
        if ($count > 0) {
            echo json_encode(array("status" => true, "data" => $data));
        } else {
            echo json_encode(array( 
                "status" => false,
                "message"=>$message
            ));
        }
        return $count;

    }
    else{
        return $count;
    }
    
}

function insertData($table, $message,$data, $json = true)
{
    global $con;
    foreach ($data as $field => $v)
        $ins[] = ':' . $field;
    $ins = implode(',', $ins);
    $fields = implode(',', array_keys($data));
    $sql = "INSERT INTO $table ($fields) VALUES ($ins)";

    $stmt = $con->prepare($sql);
    foreach ($data as $f => $v) {
        $stmt->bindValue(':' . $f, $v);
    }
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array( 
                "status" => false,
                "message"=>$message
            ));
        }
    }
    return $count;
}


function updateData($table, $message,$data, $where, $json = true)
{
    global $con;
    $cols = array();
    $vals = array();

    foreach ($data as $key => $val) {
        $vals[] = "$val";
        $cols[] = "`$key` =  ? ";
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

    $stmt = $con->prepare($sql);
    $stmt->execute($vals);
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array( 
                "status" => false,
                "message"=>$message
            ));
        }
    }
    return $count;
}

function deleteData($table, $message,$where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array( 
                "status" => false,
                "message"=>$message
            ));
        }
    }
    return $count;
}
define('MB', 1048576);

function uploadfile($file, $filename,$json = true)
{


    $imagename =$filename  . rand(1, 50000)   . $_FILES[$file]['name'];
    $imagetmp = $_FILES[$file]['tmp_name'];
    $imagesize = $_FILES[$file]['size'];
    $enablextion   = array('png', 'jpg','jpeg');
    $exlodimage    = explode('.', $imagename);
    $extintion      = end($exlodimage);
    $extintion      = strtolower($extintion);
    if (!empty($imagename) && !in_array($extintion,  $enablextion)) {
      
      return 0;
    //   'يجب ان تكون صورة';;
    }
    if ($imagesize > 7 * MB) {
       
        return 1;
        //  'حجم الصورة يجب تكون اقل من 7 ميقا';
    }
    if (empty($msError)) {
        move_uploaded_file($imagetmp, 'storge/' . $imagename);
        return $imagename;

      
        
    } else {
        sendFailureResponse('فشلة اضافة الصوره');

    }

    
}

function 
sendFailureResponse($message)
{
    
    echo json_encode(array( 
        "status" => false,
        "message"=>$message
    ));

}
function DeletFile($imagename){
    if(file_exists('storge'."/".$imagename)){
       unlink('storge'."/".$imagename);
      
    }
   
    
    }
