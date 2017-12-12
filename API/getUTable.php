<?php
    require_once("./../dbconfig.php");
    $responseArray = array();
    if($dbError) {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = $dbErrorMsg;
        exit(json_encode($responseArray));
    }

    $sql = "SELECT * FROM utable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $responseArray["data"] = array();
        while($row = $result->fetch_assoc()) {
            array_push($responseArray["data"],$row);
        }
    } else {
        $responseArray["error"] = TRUE;
        $responseArray["msg"] = "No Data";
    }

    echo json_encode($responseArray);
    $conn->close();
?>
