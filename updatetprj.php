<?php
require_once('includes/database.php');
$db= new Database();
$db->connect();
$towerids=$_GET['towerids'];
$ProjInfo=$_GET['ProjInfo'];

$idsarr=explode(":",$_GET['towerids']);

// get stimsiteid of all selected towers
$selectedidsquery=" select 	STIMSiteID  from st_towerco_tb WHERE  ";

                $selectedidsquery .= " TowerId='' ";
                foreach($idsarr as $val){
                   $selectedidsquery .= " OR  " . 'TowerId' . "='" . $val . "'";
                }
                $selectedidsquery .="";
$selecteids=$db->fetch_all_array($selectedidsquery);

// check if whats exist in tprj_site
$inquery='';
foreach($selecteids as $key=>$value){
  $inquery .= "'".$value['STIMSiteID']."',";
}
$inquery .="''";
$checkquery="select  STIMSiteID  from db_tprj_site where STIMSiteID  IN ($inquery)";
$temp=$db->fetch_all_array($checkquery);
$existids=array('xxx');
 foreach($temp as $key=>$value){
    $existids[]=$value['STIMSiteID'];

}

//update tprj_site
foreach($selecteids as $key=>$value){
    $id=$value['STIMSiteID'];
    //if exist do nothing for now
    if(in_array($id,$existids)==1){
                 // for future updates
    }
    // if not exist , create new records
    else{
       $data=array('STIMSiteID'=>$id,'TPrjID'=>$ProjInfo,'IDbyTenant'=>'','NameByTenant'=>'','Notes'=>'');
       $db->query_insert('db_tprj_site',$data);
    }

}
$db->close();
echo json_encode(array('result'=>1));
?>