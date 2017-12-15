<?php

$responseArray = array();
//$setValues = str_replace("&",",",$_SERVER['QUERY_STRING']);
$paramArr = explode('&',$_SERVER['QUERY_STRING']);
$id = null;
$tableName= null;
for($i=0;$i<sizeof($paramArr);$i++) {
    $key = explode("=",$paramArr[$i])[0];
  
    if(!is_numeric(explode("=",$paramArr[$i])[1])) {
        $paramArr[$i] = explode("=",$paramArr[$i])[0]."=".'"'.explode("=",$paramArr[$i])[1].'"';
    }
  
    if($key == 'id') {
       $id = explode("=",$paramArr[$i])[1];
       array_splice($paramArr, $i, 1);
       $i--;
   }
   else if($key == 'tableName') {
       $tableName =  explode("=",$paramArr[$i])[1];
       array_splice($paramArr, $i, 1);
       $i--;
    }
}

$setValues = implode(",",$paramArr);

if(!is_null($id)) {
    require_once("./../dbconfig.php");
    $tableName = $_GET['tableName'];

    if($dbError) {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = $dbErrorMsg;
        exit(json_encode($responseArray));
    }

    $sql = "UPDATE ".$tableName." SET ".$setValues." WHERE id=".$id;
    
    if ($conn->query($sql) === TRUE) {
        $responseArray['error'] = FALSE;
        $responseArray['msg'] = "Data Updated Successfully";
        
    } else {
        $responseArray['error'] = TRUE;
        $responseArray['msg'] = "Record Not Found";
    }
    echo json_encode($responseArray); 
}
else {
    $responseArray['error'] = FALSE;
    $responseArray['msg'] = "Id not Found";
    echo json_encode($responseArray);
}
?>