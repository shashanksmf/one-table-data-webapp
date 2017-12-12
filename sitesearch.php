<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chr ome=1">

    <!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Microsoft clear type rendering -->
	<meta http-equiv="cleartype" content="on">

	<title>Search site and tower database</title>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.16"></script>
    <script charset="UTF-8" type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
    <script src="js/libs/jquery-1.8.2.min.js"></script>
    <script src="js/libs/modernizr.custom.js"></script>
    <!-- ui lib(responsive feature) -->
    <link rel="stylesheet" href="ui-lib/css/reset.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/style.css?v=1">
	<link rel="stylesheet" href="ui-lib/css/colors.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/styles/modal.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/styles/form.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/progress-slider.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/tables.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/datatable.css?v=1">
    <link rel="stylesheet" href="ui-lib/css/dataTables.colVis.css?v=1">

    <link rel="stylesheet" href="ui-lib/js/libs/developr.validationEngine.css">
    <link rel="stylesheet" href="ui-lib/css/c3.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 480px)" href="ui-lib/css/480.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 768px)" href="ui-lib/css/768.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 992px)" href="ui-lib/css/992.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 1200px)" href="ui-lib/css/1200.css?v=1">
    <!-- Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link href='css/style.css' rel='stylesheet' />
    <link href='css/dataTables.tableTools.css' rel='stylesheet' />
    <style>
         body { margin:0; padding:0;height:100%;font-family:arial }
          html, body {
            height : 100%;
	    }
        #map-google,#map-bing {
           width:100%;
           min-height:400px;
           position:relative
        }
        #open-menu {
            top:35px
        }
        #menu{
            top:78px;
            box-shadow: 0px 1px 0px rgba(255, 255, 255, 0.5) inset, 0px 1px 3px rgba(0, 0, 0, 0.8);
        }
        .standard-tabs > .tabs{
            height:40px;
            padding-top:0px;
            top:-4px

        }
        .accordion {
          border-radius:0px
        }
         .selectcustom{
                border-radius: 4px;padding: 0px 9px;border: 0px none;padding-top: 3px;padding-bottom: 3px;line-height: 16px;box-shadow: 0px 0px 0px 1px rgba(51, 153, 255, 0) inset, 0px 2px 5px rgba(0, 0, 0, 0.35) inset, 0px 1px 1px rgba(255, 255, 255, 0.5), 0px 0px 0px rgba(51, 153, 255, 0);background: -moz-linear-gradient(center top , #FFF, #E6E6E6) repeat scroll 0% 0% transparent;
         }
        .modalposition{
            padding:2px;
            margin:2px;
            border:2px

        }

    </style>
</head>

<?php
$ProjInfo = isset($_POST['ProjInfo']) ? $_POST['ProjInfo'] : '';
$ProjInfo='SPR201301';
require_once('includes/database.php');
$db= new Database();
    $db->connect();
$mtaquery= 'SELECT mtaname, count( mtaname ) as cnt FROM st_towerco_tb GROUP BY mtaname';
$btaquery= 'select mtaname,btaname, count(btaname) as cnt from st_towerco_tb group by btaname order by mtaname asc';
$towerownersquery='select distinct TowerOwner from st_towerco_tb where TowerOwner!=""';
$mtadata=$db->fetch_all_array($mtaquery);
$btadata=$db->fetch_all_array($btaquery);
$towerownersdata=$db->fetch_all_array($towerownersquery);
$btajson=array();
foreach($mtadata as $mta){
	$btajson[$mta['mtaname']]=array();
}

foreach($btadata as $row){
	$btajson[$row['mtaname']][]=array($row['btaname'],$row['cnt']);
}
$db->close();
?>


<body class="clearfix with-menu">
  <!-- Prompt IE 6 users to install Chrome Frame -->
	<!--[if lt IE 7]><p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <!-- Button to open/hide menu -->
	<a href="#" id="open-menu"><span>Menu</span></a>
    <!-- Main content -->
	<section role="main" id="main">

		<!-- Visible only to browsers without javascript -->
		<noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>

		<!-- Main title -->
		<hgroup id="main-title" class="thin" style='height:50px'>

			<h2 class='' style='top:68px;font-size:14px;z-index:1000' id='main-search-wrapper'>
                <span class="input ">
                   <form method="post" action="#" id='frm-search-latlng' style='padding-bottom: 2px;'>
                      <span class="info-spot on-left"><span class="icon-info-round"></span><span class="info-bubble">Click <i class="icon-page-list"></i> to show search options</span></span>
                      <input name="dec-lat" id="dec-lat" class="input-unstyled input-sep validate[required]" placeholder="Latitude" value="" maxlength="50" style='width:100px' type="text">
  			   	      <input name="dec-lng" id="dec-lng" class="input-unstyled input-sep validate[required]" placeholder="Longitude" value="" maxlength="50" style='width:100px' type="text">
                      <input name="dec-radius" id="dec-radius" class="input-unstyled validate[required]" placeholder="Radius MI" style='width:70px' value=""  maxlength="2" type="text">
                      <select id='tower-owners-latlng' name="tower-owners" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px'>
                            <option value="all">Owner:All</option>
                            <?php
                                foreach($towerownersdata as $tower){
                             ?>
                             <option value="<?php echo $tower['TowerOwner']; ?>"><?php echo $tower['TowerOwner']; ?></option>
                             <?php
                                }
                            ?>
                      </select>
                      <a href="javascript:void(0)" class="button blue-gradient glossy" id='btn-search-latlng'>Search </a>
                   </form>
                   <form method="post" action="#" id='frm-search-mtabta' style='padding-bottom: 2px;display:none'>
                      <span class="info-spot on-left"><span class="icon-info-round"></span><span class="info-bubble">Click <i class="icon-page-list"></i> to show search options</span></span>
                      <select id='slc-mta' name="slc-mta" class="select compact mid-margin-left  expandable-list" style='width:200px;'>
                        <option value='none' selected>MTA Name</option>
                        <?php
                            foreach($mtadata as $mta){
                        ?>
                        <option value="<?php echo $mta['mtaname']; ?>"><?php echo $mta['mtaname'], ' (' , $mta['cnt'],')'; ?></option>
                        <?php
                            }
                        ?>
                      </select>
                      <select id='slc-bta' name="slc-bta" class="select  compact mid-margin-left mid-margin-right expandable-list " style='width:200px;'>
                           <option value='none' >BTA Name</option>
                      </select>
                      <select id='tower-owners-mtabta' name="tower-owners" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px'>
                            <option value="all">Owner:All</option>
                            <?php
                                foreach($towerownersdata as $tower){
                             ?>
                             <option value="<?php echo $tower['TowerOwner']; ?>"><?php echo $tower['TowerOwner']; ?></option>
                             <?php
                                }
                            ?>
                      </select>
                      <a href="javascript:void(0)" class="button blue-gradient glossy" id='btn-search-mtabta'>Search </a>
                   </form>
                   <form method="post" action="#" id='frm-search-address' style='padding-bottom: 2px;display:none'>
                      <span class="info-spot on-left"><span class="icon-info-round"></span><span class="info-bubble">Click <i class="icon-page-list"></i> to show search options</span></span>
                      <input name="address" id="address" class="input-unstyled input-sep" placeholder="Street Address" value="" maxlength="50" style='width:100px' type="text">
  			   	      <input name="city" id="city" class="input-unstyled input-sep" placeholder="City" value="" maxlength="50" style='width:100px' type="text">
                      <select id='state' name="state" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px' >

		<option value="">State</option>
		<option value="AK">Alaska</option>
		<option value="AL">Alabama</option>
		<option value="AR">Arkansas</option>
		<option value="AZ">Arizona</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DC">District of Columbia</option>
		<option value="DE">Delaware</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="IA">Iowa</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="MA">Massachusetts</option>
		<option value="MD">Maryland</option>
		<option value="ME">Maine</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MO">Missouri</option>
		<option value="MS">Mississippi</option>
		<option value="MT">Montana</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="NE">Nebraska</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NV">Nevada</option>
		<option value="NY">New York</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VA">Virginia</option>
		<option value="VT">Vermont</option>
		<option value="WA">Washington</option>
		<option value="WI">Wisconsin</option>
		<option value="WV">West Virginia</option>
		<option value="WY">Wyoming</option>
		<option value="PR">Puerto Rico</option>
		<option value="VI">Virgin Islands</option>

	</select>

                      <input name="county" id="county" class="input-unstyled input-sep" placeholder="County" value="" maxlength="50" style='width:50px' type="text">
                      <input name="dec-radius" id="addr-dec-radius" class="input-unstyled" placeholder="Radius MI" value="" maxlength="10" style='width:70px'  type="text">
                      <select id='tower-owners-address' name="tower-owners" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px'>
                            <option value="all">Owner:All</option>
                            <?php
                                foreach($towerownersdata as $tower){
                             ?>
                             <option value="<?php echo $tower['TowerOwner']; ?>"><?php echo $tower['TowerOwner']; ?></option>
                             <?php
                                }
                            ?>
                      </select>
                      <a href="javascript:void(0)" class="button blue-gradient glossy" id='btn-search-address'>Search </a>
                   </form>
                   <form method="post" action="#" id='frm-search-site' style='padding-bottom: 2px;display:none'>
                      <span class="info-spot on-left"><span class="icon-info-round"></span><span class="info-bubble">Click <i class="icon-page-list"></i> to show search options</span></span>
                      <input name="site-name" id="site-name" class="input-unstyled input-sep" placeholder="Site Name" value="" maxlength="50" style='width:100px' type="text">
  			   	      <input name="site-number" id="site-number" class="input-unstyled input-sep" placeholder="Site Number" value="" maxlength="50" style='width:100px' type="text">
                      <input name="asrfcc-number" id="asrfcc-number" class="input-unstyled" placeholder="ASR/FCC Number" value=""  maxlength="50" style='width:100px' type="text">
                      <select id='tower-owners-name' name="tower-owners" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px'>
                            <option value="all">Owner:All</option>
                            <?php
                                foreach($towerownersdata as $tower){
                             ?>
                             <option value="<?php echo $tower['TowerOwner']; ?>"><?php echo $tower['TowerOwner']; ?></option>
                             <?php
                                }
                            ?>
                      </select>
                      <a href="javascript:void(0)" class="button blue-gradient glossy" id='btn-search-name'>Search </a>
                   </form>
                </span>
                <a href="javascript:void(0)" id='btn-search-type' class='button blue-gradient'  >
                    <i class="icon-page-list icon-size1"></i>
                </a>
                <div id="block-search-type" style='display:none '>
						<select id='slc-search-type' class="select multiple white-gradient  check-list">
							<option value="1" selected>Latitude/Longitude</option>
							<option value="2">MTA/BTA</option>
							<option value="3" >Address/Location</option>
							<option value="4">Site Name,Number or ASR Number</option>
						</select>
				</div>
            </h2>
		</hgroup>


		<!-- The padding wrapper may be omitted -->
		<div class="with-padding">

			<!-- Wrapper, set tabs style class here -->
<div class="standard-tabs">

	<!-- Tabs -->
	<ul class="tabs">
		<li class="active"><a href="#list_view" class='with-med-padding' style="padding-bottom:12px;padding-top:12px"><i class="icon-list icon-size2"> </i> List Liew</a></li>
		<li><a href="#map_view" class='with-med-padding' style="padding-bottom:12px;padding-top:12px"><i class="icon-marker icon-size2"> </i> Map View</a></li>
	</ul>

	<!-- Content -->
	<div class="tabs-content">

        <div id="list_view"  style='padding:5px 20px 20px 20px'>
        <div class="colvisopts with-small-padding" id="colvisopts">

            <div class="showhidemenu" style='width:200px;display:inline-block'>
            <a href="javascript:void(0)" class="button blue-gradient glossy" id="btn-show-hide-cols">Show/Hide Columns</a>
            <div id='block-cols-list' style='display:none'>
               <!-- <center><a href="javascript:void(0)" class="button compact blue-gradient">Update Results</a></center>-->
            </div>
            </div>
            <div class='float-right' style="margin-right:10px;padding-top:5px"><small>In printing mode, click "ESC" in keyboard to go back in main page</small></div>
        </div>
        <table class="table responsive-table responsive-table-on dataTable" id="table-list-view" >
        </table>
		</div>

		<div id="map_view" class="with-padding">
            <div class="side-tabs  same-height margin-bottom">
            <ul class="tabs">
		        <li class="active" ><a href="#tab-map-google" class='with-med-padding'>Google Map</a></li>
		        <li ><a href="#tab-map-bing" class='with-med-padding'> Bing Map </a></li>
	        </ul>
            <!-- Content -->
	        <div class="tabs-content">
                <div id="tab-map-google">
                     <div id="map-google"></div>
                </div>
                <div id="tab-map-bing" >
                    <div id="map-bing" style='position:relative;width:100%;height:320px'></div>
                </div>


            </div>
            </div>
		</div>

	</div>

</div>

		</div>

	</section>
	<!-- End main content -->
	<!-- Sidebar/drop-down menu -->
	<section id="menu" role="complementary" class="scrollable">

		<!-- This wrapper is used by several responsive layouts -->
    	<div id="menu-content">

			<header>
				Filter Results
			</header>
             <dl class="accordion white-bg with-mid-padding" id="acd-filter-menu">
       		 </dl>
		</div>
		<!-- End content wrapper -->

		<!-- This is optional -->
		<footer id="menu-footer">
			<!-- Any content -->
		</footer>

	</section>
	<!-- End sidebar/drop-down menu -->
   <!-- JavaScript at the bottom for fast page loading -->
    <script>
        MTABTAOBJECTS=<?php  print json_encode($btajson); ?>;
        PROJECTINFO='<?php echo $ProjInfo;?>';
    </script>
    <script src="ui-lib/js/setup.js"></script>
    <script src="ui-lib/js/developr.auto-resizing.js"></script>
    <script src="ui-lib/js/developr.modal.js"></script>
	<script src="ui-lib/js/developr.input.js"></script>
    <script src="ui-lib/js/developr.scroll.js"></script>
    <script src="ui-lib/js/developr.tooltip.js"></script>
    <script src="ui-lib/js/developr.message.js"></script>
    <script src="ui-lib/js/developr.notify.js"></script>
    <script src="ui-lib/js/developr.tabs.js"></script>
    <script src="ui-lib/js/developr.table.js"></script>
    <script src="ui-lib/js/developr.accordion.js"></script>
    <script src="ui-lib/js/developr.progress-slider.js"></script>
    <script src="ui-lib/js/libs/query.validationEngine.js"></script>
    <script src="ui-lib/js/libs/jquery.validationEngine-en.js"></script>
    <script src="ui-lib/js/libs/jquery.details.min.js"></script>
    <script src="js/libs/jquery.dataTables.min.js"></script>
     <script src="js/libs/dataTables.tableTools.js"></script>
    <script src="js/libs/dataTables.colVis.js"></script>
    <script src="js/mapapp.js"></script>
    <script src="js/mapappbing.js"></script>
    <script src="js/colsmanager.js"></script>
    <script src="js/main.js"></script>



</body>
</html>