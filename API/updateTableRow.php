<?php
$responseArray = array();
//$setValues = str_replace("&",",",$_SERVER['QUERY_STRING']);
$paramArr = explode('&',$_SERVER['QUERY_STRING']);

$id = null;
$tableName= null;
for($i=0;$i<sizeof($paramArr);$i++) {
    $key = explode("=",$paramArr[$i])[0];
    if(empty(explode("=",$paramArr[$i])[1])) {
        continue;
    }
    $value = urldecode(explode("=",$paramArr[$i])[1]);
    if(!is_numeric($value) && $value !== 'null') {
        $paramArr[$i] = $key."=".'"'.$value.'"';
    }
  
    if($key == 'id') {
       $id = $value;
       array_splice($paramArr, $i, 1);
       $i--;
   }
   else if($key == 'tableName') {
       $tableName =  $value;
       array_splice($paramArr, $i, 1);
       $i--;
    }
}

$setValues = implode(",",$paramArr);
$lastchar = substr(trim($setValues), -1);
if($lastchar == ",") {
  $setValues = substr(trim($setValues), 0,-1);
}
//echo trim($setValues);
//exit();
if(!is_null($id)) {
    require_once("./../dbconfig.php");
    $tableName = $_GET['tableName'];

    if($dbError) {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = $dbErrorMsg;
        exit(json_encode($responseArray));
    }

    $sql = "UPDATE ".$tableName." SET ".$setValues." WHERE id=".$id;
    //echo $sql."<br/>";
    if ($conn->query($sql) === TRUE) {
        $responseArray['error'] = FALSE;
        $responseArray['msg'] = "Data Updated Successfully";
        
    } else {
        $responseArray['error'] = TRUE;
        $responseArray['msg'] =  $conn->error;
    }
    echo json_encode($responseArray); 
}
else {
    $responseArray['error'] = FALSE;
    $responseArray['msg'] = "Id not Found";
    echo json_encode($responseArray);
}
?>