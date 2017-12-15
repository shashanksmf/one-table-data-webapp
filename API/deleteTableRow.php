<?php

require_once("./../dbconfig.php");
if($dbError) {
    $responseArray["error"] = TRUE;
    $responseArray["msg"] = $dbErrorMsg;
    exit(json_encode($responseArray));
}
$responseArr = array();
$tableName = $_GET['tableName'];
$id = $_GET['id'];
// sql to delete a record
$sql = "DELETE FROM ". $tableName ." WHERE id=".$id;

if (mysqli_query($conn, $sql)) {
  $responseArr['error'] = FALSE;
  $responseArr['msg'] = 'Deleted Successfully';
} else {
    $responseArr['error'] = TRUE;
    $responseArr['msg'] =  mysqli_error($conn);
   // echo "Error deleting record: " . mysqli_error($conn);
}

echo json_encode($responseArr);

mysqli_close($conn);
?>