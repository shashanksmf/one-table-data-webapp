<?php
    require_once('includes/database.php');
    $db= new Database();
    $db->connect();
    if(!isset($_GET['ajax']))
        return 0;

    $searchtype=$_GET['searchtype'];
    $defaultfields="Latitude,Longitude,TowerId,SiteName,Address,City,County,State,Height,StructureClassification,TowerOwner";

    // column fields
    $colsfields=explode(":",$_GET["cols"]);

    // we always need the default fields even one of it is not selected in the hide/show column. this is because its needed
    // in the filter menu. so lets just merge the selected columns and the defaulte columns/fields
    $finalarray=array_unique(array_merge(explode(',',$defaultfields),$colsfields));

    if(count($colsfields)==0)
        $colsfields=$defaultfields;

    $defaultfields=implode(',',$finalarray);

    /*build filters */
    // always include the following fields for filters */
    $filtersInclude=array('City','County','State','StructureClassification','TowerOwner');

    // build the WHERE QUERY */
    $qfs=" WHERE 1 ";
    foreach($filtersInclude as $filter){

            if(isset($_GET["$filter"])){
                if($_GET["$filter"]=="")
                   continue;
                $qfs .=" AND ( ";
                $qfs .= " $filter='' ";
                $vals=explode(":",$_GET["$filter"]);
                foreach($vals as $val){
                   $qfs .= " OR  " . $filter . "='" . $val . "'";
                }
                $qfs .=" ) ";
            }
    }

    if($searchtype=='radius'){
      radiusSearch($db,$defaultfields,$qfs,$colsfields);
    }
    else if($searchtype=='mtabta'){
      mtabtaSearch($db,$defaultfields,$qfs,$colsfields);
    }
    else if($searchtype=='name'){
      nameSearch($db,$defaultfields,$qfs,$colsfields);
    }
   else if($searchtype=='address'){
      addressSearch($db,$defaultfields,$qfs,$colsfields);
    }

   /* proces results in to json object */
   function processResults($data,$colsfields){
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


    /* when address search */
    function addressSearch($db,$defaultfields,$filter,$colsfields){
        $towerowners= trim($_GET['towerowners']);
        $faddress=trim($_GET['faddress']);
        $fcity=trim($_GET['fcity']);
        $fcounty=trim($_GET['fcounty']);
        $fstate=trim($_GET['fstate']);
        $table="st_towerco_tb";
        $qfs=" $filter  AND (";
        $temparr=array();
        if($faddress !='')
         $temparr[]=" Address LIKE '%".$faddress."%' ";
        if($fcity!='')
          $temparr[] =" City  LIKE '".$fcity."%' ";
        if($fcounty!='')
          $temparr[] =" County='".$fcounty."' ";
        if($fstate!='')
          $temparr[] =" State='".$fstate."' ";
          $ctr=0;
        if($towerowners!='all'){
          $towerowerand =" and TowerOwner='$towerowners' ";

        $temparr[] =" TowerOwner='".$towerowners."' ";    }

      foreach($temparr as $item){
           if($ctr!=0)
               $qfs .=" AND ";
           $ctr++;
           $qfs .= $item;
        }
      $qfs .= ")";

      $sitenameq="SELECT  $defaultfields from $table $qfs  limit 1000";

      //echo $sitenameq;
     $data=$db->fetch_all_array($sitenameq);
      processResults($data,$colsfields);
    }

    /* when name search */
    function nameSearch($db,$defaultfields,$filter,$colsfields){
      $sitename=trim($_GET['sitename']);
      $towerid=trim($_GET['towerid']);
      $fccnumber=trim($_GET['fccnumber']);
      $table="st_towerco_tb";
      $qfs=" $filter AND (";
      $temparr=array();
      if($sitename !='')
         $temparr[]=" SiteName LIKE '".$sitename."%' ";
      if($towerid!='')
          $temparr[] =" TowerId  LIKE '".$towerid."%' ";
      if($fccnumber!='')
          $temparr[] =" FCCNumber LIKE '".$fccnumber."%' ";

      $ctr=0;

      $towerowners= trim($_GET['towerowners']);
      $towerowerand='';
      if($towerowners!='all')
          $towerowerand =" and TowerOwner='$towerowners' ";

      foreach($temparr as $item){
           if($ctr!=0)
               $qfs .=" OR ";
           $ctr++;
           $qfs .= $item;
      }
      $qfs .= ")";


      $sitenameq="SELECT  $defaultfields from $table $qfs $towerowerand  limit 1000 ";
      $data=$db->fetch_all_array($sitenameq);
      processResults($data,$colsfields);

    }

    /* when mtabta search */
    function mtabtaSearch($db,$defaultfields,$qfs,$colsfields){
      $mta=$_GET['mta'];
      $bta=$_GET['bta'];
      $table="st_towerco_tb";

      $towerowners= trim($_GET['towerowners']);
      $towerowerand='';
      if($towerowners!='all')
          $towerowerand =" and TowerOwner='$towerowners' ";

      $mtabtaq="select $defaultfields from $table $qfs AND (MTAName='$mta' and BTAName='$bta') $towerowerand ";
      $data=$db->fetch_all_array($mtabtaq);
      processResults($data,$colsfields);
    }

    /* when radius search */
    function radiusSearch($db,$defaultfields,$qfs,$colsfields){
      $lat=$_GET['lat'];
      $lng=$_GET['lng'];
      $radius=$_GET['radius'];
      $table='st_towerco_tb';

      $towerowners= trim($_GET['towerowners']);
      $towerowerand='';
      if($towerowners!='all')
          $towerowerand =" and TowerOwner='$towerowners' ";

      $limit=100000;
      $radiusquery="SELECT $defaultfields, ( 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( latitude ) ) ) ) AS distance FROM $table $qfs $towerowerand HAVING distance < $radius  ORDER BY distance asc limit $limit";
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
        echo json_encode(array('fields'=> $colsfields,'tabledata'=>$trimdata,'mapdata'=>$mapdata));
    }
 $db->close();
?>