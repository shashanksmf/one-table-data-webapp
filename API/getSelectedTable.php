<?php
    require_once("./../dbconfig.php");
    $responseArray = array();
    $tableName = $_GET['tableName'];

    if($dbError) {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = $dbErrorMsg;
        exit(json_encode($responseArray));
    }

    if(!isset($tableName) || is_null($tableName) || strlen($tableName) == 0) {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = "TableName Not Found!";
        exit(json_encode($responseArray));
    } 

    $sql = "SELECT * FROM ". $tableName. " ;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $responseArray["data"] = array();
        $responseArray["key"] = array(); 
        while($row = $result->fetch_assoc()) { 
            if(sizeof($responseArray["key"]) == 0) {
               $responseArray["key"] = array_keys($row);
            }
            array_push($responseArray["data"],$row);
        }
    } else {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = "No Data";
    }

    echo json_encode($responseArray);
    $conn->close();
?>
