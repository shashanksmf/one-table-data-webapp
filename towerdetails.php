<?php
error_reporting(E_ERROR);
  require_once('includes/database.php');
  $db= new Database();
  $db->connect();
  $id=$_GET['towerid'];
  $data=$db->fetch_all_array("select * from towers where TowerId='$id' limit 1");
  $datum=$data[0];
  $imageURL='towerimages/' . $datum['TowerId'] . ".jpg";
  if (getimagesize($imageURL) === false) {
      $imageURL='towerimages/default.jpeg';
  }
   $db->close();
?>
<h2 class='blue'>Tower ID : <?php echo $datum['TowerId']; ?></h2>
<input class='details-latlng' type='hidden' value='<?php echo $datum['Latitude'],':',$datum['Longitude']; ?>'>
<div class="standard-tabs">

	<!-- Tabs -->
	<ul class="tabs same-height">
		<li class="active"><a href="#details_lview" class='with-small-padding'> Details</a></li>
		<li><a href="#details_gmap" class='with-small-padding'> Google Map</a></li>
        <li><a href="#details_bmap" class='with-small-padding'> Bing Map</a></li>
	</ul>

	<!-- Content -->
	<div class="tabs-content" id='details-tabs-content'>
        <div id="details_lview" class="" >
            <div class="columns with-padding">
                <div class="six-columns  align-center">
                    <div class="with-small-padding">
                        <img src="<?php echo $imageURL;?>" style="height:260px" >
                    </div>
                </div>
                <div class="six-columns scrollable" style="height:280px" >
                <ul class="bullet-list "  >
                <?php
                  foreach($datum as $key=>$value){
                      print "<li><span class='green strong'>$key:</span> $value </li>";
                  }
                ?>

                </ul>
                </div>
            </div>
        </div>
        <div id="details_gmap" class="with-small-padding" style='position:relative;width:100%;height:320px'>
        </div>
        <div id="details_bmap" class="with-small-padding" style='position:relative;width:100%;height:320px'>
        </div>

    </div>
</div>