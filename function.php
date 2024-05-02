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
function getAllData($table, $where = null, $values = null,$jeson=true)
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
            echo json_encode(array("status" => false));
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
function getData($table, $where = null, $values = null,$jeson=true)
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
            echo json_encode(array("status" => false));
        }
        return $count;

    }
    else{
        return $count;
    }
    
}

function insertData($table, $data, $json = true)
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
            echo json_encode(array("status" => false));
        }
    }
    return $count;
}


function updateData($table, $data, $where, $json = true)
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
            echo json_encode(array("status" => false));
        }
    }
    return $count;
}

function deleteData($table, $where, $json = true)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($json == true) {
        if ($count > 0) {
            echo json_encode(array("status" => true));
        } else {
            echo json_encode(array("status" => false));
        }
    }
    return $count;
}



function 
sendFailureResponse($message)
{
    
    echo json_encode(array( 
        "status" => false,
        "message"=>$message
    ));

}

