<?php
  require_once('includes/database.php');
  $db= new Database();
  $db->connect();
  $data=$db->fetch_all_array('select Latitude,Longitude from towers limit 100');
  $dataformap=array();
  foreach($data as $d){
  //  $towers[]=array($d["TowerId"],$d["SiteName"],$d["Address"],$d["City"],$d["County"],$d["State"],$d["Zipcode"],$d["Latitude"],$d["Longitude"],$d["Height"],$d["StructureType"],$d["StructureClassification"],$d["FirstName"],$d["LastName"],$d["Phone"],$d["Email"],$d["Region"],$d["TowerOwner"],$d["BTANumber"],$d["MTANumber"],$d["MTAName"],$d["BTAName"],$d["NewSite"],$d["FCCNumber"],$d["TowerOwner_Short"],$d["StateId"]);
   // $towers[]=array($d["TowerId"],$d["SiteName"],$d["Address"],$d["City"],$d["County"],$d["State"],);
    $dataformap[]=array('latLng'=> array($museum['Latitude'] , $museum['Longitude']));
  }
  $dataformap=array('data'=>$towers);
  echo json_encode($dataformap);
?>
