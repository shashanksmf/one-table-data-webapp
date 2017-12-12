<?php
    require_once('includes/database.php');
    $db= new Database();
    $db->connect();
    $defaultfields="Latitude,Longitude,TowerId,SiteName,Address,City,County,State,Height,StructureClassification,TowerOwner";
    // column fields
    $colsfields=explode(":",$_GET["cols"]);

    // we always need the default fields even one of it is not selected in the hide/show column. this is because its needed
    // in the filter menu. so lets just merge the selected columns and the defaulte columns/fields
    $finalarray=array_unique(array_merge(explode(',',$defaultfields),$colsfields));
    if(count($colsfields)==0)
        $colsfields=$defaultfields;

    $defaultfields=implode(',',$finalarray);

     if(!isset($_GET['ajax']))
        return 0;

    $searchtype=$_GET['searchtype'];
    if($searchtype=='radius'){
      radiusSearch($db,$defaultfields,$colsfields);

    }
    else if($searchtype=='mtabta'){
      mtabtaSearch($db,$defaultfields,$colsfields);
    }
    else if($searchtype=='name'){
      nameSearch($db,$defaultfields,$colsfields);
    }
    else if($searchtype=='address'){
      addressSearch($db,$defaultfields,$colsfields);
    }


    /* proces results in to json object */
    function processResults($data,$colsfields,$extra=null){
      $towers=array();
      $mapdata=array();
      foreach($data as $d){
       //   $towers[]=array( $d['TowerId'] ,$d["SiteName"],trim($d["Address"]),trim($d["City"]),trim($d["County"]),$d["Height"],$d["StructureType"],$d["TowerOwner"]);

        $mapdata[]=array('data'=>array("towerid"=>$d["TowerId"],"latlng"=> array((float)$d['Latitude'] , (float)$d['Longitude'])),
                            'id'=>$d["TowerId"],
                            'icon'=>"img/cell_id.png",
                            'latlng'=> array((float)$d['Latitude'] , (float)$d['Longitude']));
      }
      $fields=array();
      if(isset($data[0])){
         foreach($data[0] as $key=>$value){
               $fields[]=$key;
         }
      }
      $trimdata=array();
      foreach($data as $row){
            $trimrow=array();
            foreach($row as $field=>$value){
                  $trimrow[$field]=trim($value);
            }
            $trimdata[]=$trimrow;
      }
        if($extra!=null)
            echo json_encode(array("counts"=>$extra,'fields'=>$colsfields,'tabledata'=>$trimdata,'mapdata'=>$mapdata));
        else
            echo json_encode(array('fields'=>$colsfields,'tabledata'=>$trimdata,'mapdata'=>$mapdata));
    }

    /* when address search */
    function addressSearch($db,$defaultfields,$colsfields){
        $towerowerand='';
        $faddress=trim($_GET['faddress']);
        $fcity=trim($_GET['fcity']);
        $fcounty=trim($_GET['fcounty']);
        $fstate=trim($_GET['fstate']);
        $towerowners= trim($_GET['towerowners']);

        $table="st_towerco_tb";
        $qfs=" WHERE 1 AND (";
        $temparr=array();
        if($faddress !='')
         $temparr[]=" Address LIKE '%".$faddress."%' ";
        if($fcity!='')
          $temparr[] =" City  LIKE '".$fcity."%' ";
        if($fcounty!='')
          $temparr[] =" County='".$fcounty."' ";
        if($fstate!='')
          $temparr[] =" State='".$fstate."' ";
        if($towerowners!='all'){
          $towerowerand =" and TowerOwner='$towerowners' ";

        $temparr[] =" TowerOwner='".$towerowners."' ";    }
          $ctr=0;

      foreach($temparr as $item){
           if($ctr!=0)
               $qfs .=" AND ";
           $ctr++;
           $qfs .= $item;
        }
      $qfs .= ")";

      $sitenameq="SELECT  $defaultfields from $table $qfs  limit 1000";
      $countresults=array();
      if($fcity=='' && $fcounty==''){
         $citycountquery="SELECT city as name, count( * ) AS counter FROM st_towerco_tb WHERE state = '$fstate' $towerowerand GROUP BY city";
         $countycountquery="SELECT county  as name, count( * ) AS counter FROM st_towerco_tb WHERE state = '$fstate' $towerowerand GROUP BY county";
         $sccountquery="SELECT StructureClassification  as name, count( * ) AS counter FROM st_towerco_tb WHERE state = '$fstate' $towerowerand GROUP BY StructureClassification";
         $towerownercountquery="SELECT TowerOwner  as name, count( * ) AS counter FROM st_towerco_tb WHERE state = '$fstate' $towerowerand  GROUP BY TowerOwner";
         $statecountquery="SELECT state  as name, count( * ) AS counter FROM st_towerco_tb WHERE state = '$fstate' $towerowerand  GROUP BY state";
         $countresults['City']=$db->fetch_all_array($citycountquery);
         $countresults['County']=$db->fetch_all_array($countycountquery);
         $countresults['StructureClassification']=$db->fetch_all_array($sccountquery);
         $countresults['TowerOwner']=$db->fetch_all_array($towerownercountquery);
         $countresults['State']=$db->fetch_all_array($statecountquery);
        $data=$db->fetch_all_array($sitenameq);
        processResults($data,$colsfields,$countresults);
      }
      else{
        $data=$db->fetch_all_array($sitenameq);
        processResults($data,$colsfields);
      }
      //print_r($countresults);

    }

    /* when address search */
    function nameSearch($db,$defaultfields,$colsfields){
      $sitename=trim($_GET['sitename']);
      $towerid=trim($_GET['towerid']);
      $fccnumber=trim($_GET['fccnumber']);
      $table="st_towerco_tb";
      $qfs=" WHERE 1 AND (";
      $temparr=array();
      if($sitename !='')
         $temparr[]=" SiteName LIKE '".$sitename."%' ";
      if($towerid!='')
          $temparr[] =" TowerId  LIKE '".$towerid."%' ";
      if($fccnumber!='')
          $temparr[] =" FCCNumber LIKE '".$fccnumber."%' ";


      $towerowners= trim($_GET['towerowners']);
      $towerowerand='';
      if($towerowners!='all')
          $towerowerand =" and TowerOwner='$towerowners' ";

      $ctr=0;
      foreach($temparr as $item){
           if($ctr!=0)
               $qfs .=" OR ";
           $ctr++;
           $qfs .= $item;
      }
      $qfs .= ")";

      $towerowners= trim($_GET['towerowners']);
      if($towerowners!='all')
          $temparr[] =" TowerOwner='".$towerowners."' ";

      $sitenameq="SELECT  $defaultfields from $table $qfs  $towerowerand  limit 1000";
      $data=$db->fetch_all_array($sitenameq);
      processResults($data,$colsfields);

    }

    /* when address search */
    function mtabtaSearch($db,$defaultfields,$colsfields){
      $mta=$_GET['mta'];
      $bta=$_GET['bta'];

      $towerowners= trim($_GET['towerowners']);
      $towerowerand='';
      if($towerowners!='all')
          $towerowerand =" and TowerOwner='$towerowners' ";

      $table="st_towerco_tb";
      $mtabtaq="select $defaultfields from $table where MTAName='$mta' and BTAName='$bta' $towerowerand ";
      $data=$db->fetch_all_array($mtabtaq);
      processResults($data,$colsfields);
    }

    /* when address search */
    function radiusSearch($db,$defaultfields,$colsfields){
      $lat=$_GET['lat'];
      $lng=$_GET['lng'];
      $radius=$_GET['radius'];
       $towerowners= trim($_GET['towerowners']);
      $towerowerand='';
      if($towerowners!='all')
          $towerowerand =" WHERE TowerOwner='$towerowners' ";

      $table='st_towerco_tb';
      $limit=100000;
      $radiusquery="SELECT $defaultfields, ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM $table $towerowerand HAVING distance < $radius ORDER BY distance asc limit $limit";
      $data=$db->fetch_all_array($radiusquery);
      $towers=array();
      $mapdata=array();
      foreach($data as $d){
       //   $towers[]=array( $d['TowerId'] ,$d["SiteName"],trim($d["Address"]),trim($d["City"]),trim($d["County"]),$d["Height"],$d["StructureType"],$d["TowerOwner"]);

        $mapdata[]=array('data'=>array("towerid"=>$d["TowerId"],"latlng"=> array((float)$d['Latitude'] , (float)$d['Longitude'])),
                            'id'=>$d["TowerId"],
                            'icon'=>"img/cell_id.png",
                            'latlng'=> array((float)$d['Latitude'] , (float)$d['Longitude']));
      }
      $fields=array();
      if(isset($data[0])){
         foreach($data[0] as $key=>$value){
               $fields[]=$key;
         }
      }
      $trimdata=array();
      foreach($data as $row){
            $trimrow=array();
            foreach($row as $field=>$value){
                  $trimrow[$field]=trim($value);
            }
            $trimdata[]=$trimrow;
      }
        echo json_encode(array('fields'=>$colsfields,'tabledata'=>$trimdata,'mapdata'=>$mapdata));
    }
 $db->close();
?>