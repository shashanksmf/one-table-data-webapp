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
<!-- 
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.16"></script>
    <script charset="UTF-8" type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script> -->
    <script src="js/libs/jquery-1.8.2.min.js"></script>
    <script src="js/libs/modernizr.custom.js"></script>
    <!-- ui lib(responsive feature) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">
    
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
            <style>
        .tables .dropbtn {
        background-color: white;
        color: black;
        padding: 4px;
        font-size: 16px;
        border:1px solid black;
        cursor: pointer;
        width: 100px;
 
    }

    .tables.dropdown {
        position: relative;
        display: inline-block;
        position: absolute;
        top: 0;
        left: 25%;

    }

    .tables .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .tables .dropdown-content a {
        color: black;
        padding: 8px;
        text-decoration: none;
        display: block;
        cursor:pointer;
    }

    .tables.dropdown:hover .dropdown-content {
        display: block;
    }


    .nowrap {
        white-space:nowrap;
    }

    </style>
      <base href="./">
</head>





<body class="clearfix with-menu"  ng-app="myApp" ng-controller="myCtrl">
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

			<h2 class='' style='top:34px;font-size:14px;z-index:1000' id='main-search-wrapper' ng-if="selectedTableName == 'st'">
                <span class="input ">
                   <form method="post" action="#" id='frm-search-latlng' style='padding-bottom: 2px;'>
                      <span class="info-spot on-left"><span class="icon-info-round"></span><span class="info-bubble">Click <i class="icon-page-list"></i> to show search options</span></span>
                      <input name="dec-lat" id="dec-lat" class="input-unstyled input-sep validate[required]" placeholder="Latitude" value="" maxlength="50" style='width:100px' type="text">
  			   	      <input name="dec-lng" id="dec-lng" class="input-unstyled input-sep validate[required]" placeholder="Longitude" value="" maxlength="50" style='width:100px' type="text">
                      <input name="dec-radius" id="dec-radius" class="input-unstyled validate[required]" placeholder="Radius MI" style='width:70px' value=""  maxlength="2" type="text">
                      <select id='tower-owners-latlng' name="tower-owners" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px'>
                            <option value="all">Owner:All</option>
                                                  </select>
                      <a href="javascript:void(0)" class="button blue-gradient glossy" id='btn-search-latlng'>Search </a>
                   </form>
                   <form method="post" action="#" id='frm-search-mtabta' style='padding-bottom: 2px;display:none'>
                      <span class="info-spot on-left"><span class="icon-info-round"></span><span class="info-bubble">Click <i class="icon-page-list"></i> to show search options</span></span>
                      <select id='slc-mta' name="slc-mta" class="select compact mid-margin-left  expandable-list" style='width:200px;'>
                        <option value='none' selected>MTA Name</option>
                        
                      </select>
                      <select id='slc-bta' name="slc-bta" class="select  compact mid-margin-left mid-margin-right expandable-list " style='width:200px;'>
                           <option value='none' >BTA Name</option>
                      </select>
                      <select id='tower-owners-mtabta' name="tower-owners" class="selectcustom   auto-open mid-margin-left mid-margin-right " style='width:100px'>
                            <option value="all">Owner:All</option>
                        
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
		<li ng-if="selectedTableName == 'st'"><a href="#map_view" class='with-med-padding' style="padding-bottom:12px;padding-top:12px"><i class="icon-marker icon-size2"> </i> Map View</a></li>
        <li><select class="selectcustom" ng-model="selectedTableName" ng-change="selectTable(selectedTableName)" ng-options="tableObj.db_tb as tableObj.db_tb for tableObj in uTableData  | unique:'table'">
        </select></li>
    </ul>
    
    <!-- <div class="tables dropdown">
        <button class="dropbtn">{{selectedTableName}}<i style="float: right;" class=" glyphicon glyphicon-chevron-down text-right"></i></button>
        <div class="dropdown-content">
            <a ng-repeat="tableObj in uTableData  | unique:'table'" ng-click="selectTable(tableObj.db_tb)">{{tableObj.table}}</a>
        </div>
    </div> -->
   

	<!-- Content -->
	<div class="tabs-content">

        <div id="list_view"  style='padding:5px 20px 20px 20px;max-width:1000px;overflow-x:scroll;min-height:500px'>
        <div class="colvisopts with-small-padding" id="colvisopts">

            <div class="showhidemenu" style='width:200px;display:inline-block'>
            <a href="javascript:void(0)" class="button blue-gradient glossy" id="btn-show-hide-cols">Show/Hide Columns</a>
            <div id='block-cols-list' style='display:none'>
               <!-- <center><a href="javascript:void(0)" class="button compact blue-gradient">Update Results</a></center>-->
            </div>
            </div>
            <div class='float-right' style="margin-right:10px;padding-top:5px"><small>In printing mode, click "ESC" in keyboard to go back in main page</small></div>
        </div>
       
       <div id="table-list-view_wrapper" class="dataTables_wrapper no-footer">
       
        <div class="dataTables_header">
            <div class="dataTables_length" id="table-list-view_length">
                <label>
                    Show 
                    <span class="select blue-gradient glossy replacement" style="width:44px" tabindex="0">
                    <span class="select-value">10</span><span class="select-arrow"></span><span class="drop-down"></span>
                    <select name="table-list-view_length" aria-controls="table-list-view" class="withClearFunctions" tabindex="-1" style="display: none;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    </span>
                    entries 
                </label>
               
            </div>
            <a style="margin-top:11px" href="javascript:void(0)" class="button blue-gradient glossy" id="btn-add-to-project">Add selected entries to project.</a>
            <div id="table-list-view_filter" class="dataTables_filter"><label>Search by Keyword:<input ng-model="searchKeyword" type="search" class="" placeholder="Within listed entries" aria-controls="table-list-view"></label></div>
        </div>
            <table class="table responsive-table responsive-table-on dataTable" id="table-list-view" >
              <thead ng-if="$index == 0" ng-repeat="tableObj in selectedTableData">

                <tr>
                    <th class="sorting nowrap" ng-repeat="(key,value) in tableObj"  ng-click="sort(key)" ng-if="checkWeb(key)">{{key}}</th>
                </tr>
            </thead>

            <tbody >
                <tr ng-repeat="tableObj in selectedTableData | orderBy:sortType:false | filter: searchKeyword " ng-if="tableObj.isFilter">
                    <td ng-if="checkWeb(key)" ng-repeat="(key,value) in tableObj">
                        <a ng-click="editSelectedData(tableObj,$parent.$parent.$parent.$index)" ng-if="isEditable(key,selectedTableName)" class="btn-tower-id" ><i class="icon-info-round"> </i> 
                            <b>{{value}}</b>
                        </a>
                        <span ng-if="!isEditable(key,selectedTableName)">{{value}}</span>
                    </td>
                </tr>
                 
                
                <tr ng-show="$index == 0" ng-if="sumArr.length > 0" ng-repeat="tableObj in selectedTableData">
                    <td ng-repeat="(key,value) in tableObj" ng-if="checkWeb(key)"><span ng-if="ifSum(key)" >{{getSum(key)}}</span></td>
                </tr>

            </tbody>
        </table>
        <div class="dataTables_footer">
            <div class="dataTables_info" id="table-list-view_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
            <div class="dataTables_paginate paging_full_numbers" id="table-list-view_paginate"><a class="paginate_button first disabled" aria-controls="table-list-view" data-dt-idx="0" tabindex="0" id="table-list-view_first">First</a><a class="paginate_button previous disabled" aria-controls="table-list-view" data-dt-idx="1" tabindex="0" id="table-list-view_previous">Previous</a><span></span><a class="paginate_button next disabled" aria-controls="table-list-view" data-dt-idx="2" tabindex="0" id="table-list-view_next">Next</a><a class="paginate_button last disabled" aria-controls="table-list-view" data-dt-idx="3" tabindex="0" id="table-list-view_last">Last</a></div>
        </div>
        </div>

   
    
		</div>

		<div id="map_view" class="with-padding" style="display:none">
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
             <dl class="accordion white-bg with-mid-padding" id="acd-filter-menu" ng-init="showTab=[]"> 
                <div ng-repeat="filterObj in filterData" >
                    <dt ng-click="showTab[$index] = !showTab[$index]">{{filterObj.key}}</dt>
                    <dd ng-show="showTab[$index] == true">
                        <div class="with-small-padding">
                            <div class="blue-bg with-small-padding filterheader">
                                <span class="checkbox  replacement" tabindex="0" ng-class="{'checked':filterObj.checkAll}" ng-click="filterObj.checkAll=!filterObj.checkAll;filterCheckAll($index,filterObj.key,filterObj.checkAll)">
                                    <span class="check-knob"></span>
                                    <input id="" checked="" class="" name="County" type="checkbox" value="County" tabindex="-1">
                                </span>
                                 Check/Uncheck All
                            </div>
                            <ul class="list">
                                <li ng-repeat="names in filterObj.val | unique: names" >
                                    <!-- addValuesToFilters(filterObj.key,names.value,names.checked) -->
                                    <span class="checkbox replacement mr5" ng-class="{'checked':names.checked}"  ng-click="names.checked=!names.checked;filterTable(filterObj.key,names.value,names.checked)">
                                            <span class="check-knob"></span>
                                            <input type="checkbox"  />
                                        </span>
                                    <span>{{names.value}}</span>
                                </li>
                            </ul>
                        </div>
                    </dd>
                    
                </div>
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
  
    <script src="ui-lib/js/setup.js"></script>
    <script src="ui-lib/js/developr.auto-resizing.js"></script>
    <script src="ui-lib/js/developr.modal.js"></script>
	<script src="ui-lib/js/developr.input.js"></script>
    <script src="ui-lib/js/developr.scroll.js"></script>
    <!-- <script src="ui-lib/js/developr.tooltip.js"></script>
    <script src="ui-lib/js/developr.message.js"></script>
    <script src="ui-lib/js/developr.notify.js"></script>
    <script src="ui-lib/js/developr.tabs.js"></script>
    <script src="ui-lib/js/developr.table.js"></script>
    <script src="ui-lib/js/developr.accordion.js"></script>
    <script src="ui-lib/js/developr.progress-slider.js"></script>
    <script src="ui-lib/js/libs/query.validationEngine.js"></script>
    <script src="ui-lib/js/libs/jquery.validationEngine-en.js"></script>
    <script src="ui-lib/js/libs/jquery.details.min.js"></script> -->
     <!-- <script src="js/mapapp.js"></script> -->
    <!-- <script src="js/libs/jquery.dataTables.min.js"></script>
     <script src="js/libs/dataTables.tableTools.js"></script>
    <script src="js/libs/dataTables.colVis.js"></script>
    <script src="js/mapappbing.js"></script>
    <script src="js/colsmanager.js"></script>
    <script src="js/main.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
    <script src="js/libs/lodash.min.js"> </script>
    <script src="js/angular/angular-filter.min.js"></script>
    <script src="js/angular/route.js"></script>
    <script src ="js/angular/API.js"></script>
    <script src="js/angular/mainController.js"></script>
    

             <!-- Pop Up Modal -->
        <div id="modals " class="with-blocker editable-modal" ng-if="showModal">
      
        <div class="modal-blocker visible"></div>
        <div class="modal" style="display:block;left: 20%;right: 30%; top: 23px; opacity: 1; margin-top: 0px;">
            <ul class="modal-actions children-tooltip">
                <li class="red-hover"><a href="#" title="Close">Close</a></li>
            </ul>
            <div class="modal-bg">
                <div class="modal-content custom-scroll" style="box-shadow: none;border: none;min-width: 200px; min-height: 16px; width: 600px; height: 450px; position: relative; max-width: 1277px; max-height: 476px;">
                    <table align="center" border="1" cellspacing="0" style="background:white;color:black;width:80%;">
                    <tbody>
                        <tr ng-repeat="(key,value) in editData" ng-if="checkIfVisible(key)">
                            <td><label>{{key}}</label></td>
                            <td ><input type="text" class="form-control"  value="{{value}}" ng-model="editData[key]"/></td>
                        </tr>
                        <tr>
                            <td><button class="btn btn-danger" ng-click="deleteRow(editData)">Delete</button></td>
                            <td><button class="btn btn-info" ng-click="updateRow(editData)">Update</button></td>
                        </tr>
                    </tbody>
                    </table>

                    <h2 class="blue">Tower ID : </h2>
                    <input class="details-latlng" type="hidden" value=":">
                    <div class="standard-tabs tabs-active" style="height: 40px;">
                    <!-- Tabs -->
                    <ul class="tabs same-height">
                        <li class="active"><a href="#details_lview" class="with-small-padding"> Details</a></li>
                        <li><a href="#details_gmap" class="with-small-padding"> Google Map</a></li>
                        <li><a href="#details_bmap" class="with-small-padding"> Bing Map</a></li>
                    </ul>
                    <!-- Content -->
                    <div class="tabs-content" id="details-tabs-content" style="min-height: 39px;">
                        <span class="tabs-back with-left-arrow top-bevel-on-light dark-text-bevel">Back</span>
                        <div id="details_lview" class="tab-active">
                            <div class="columns with-padding">
                                <div class="six-columns  align-center">
                                <div class="with-small-padding">
                                    <img src="towerimages/default.jpeg" style="height:260px">
                                </div>
                                </div>
                                <div class="six-columns scrollable custom-scroll" style="height: 280px; position: relative;">
                                <ul class="bullet-list ">
                                </ul>
                                <div class="custom-vscrollbar" style="display: none; opacity: 0;">
                                    <div></div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div id="details_gmap" class="with-small-padding" style="position: relative; width: 100%; height: 320px; display: none;">
                            <div style="height: 100%; width: 100%;"></div>
                        </div>
                        <div id="details_bmap" class="with-small-padding" style="position: relative; width: 100%; height: 320px; display: none;">
                        </div>
                    </div>
                    </div>
                    <div class="custom-vscrollbar" style="top: 6px; left: 586px; height: 438px; width: 8px; opacity: 1; display: block;">
                    <div style="top: 0px; height: 347px;"></div>
                    </div>
                </div>
                <div class="modal-buttons align-right low-padding"><button type="button" ng-click="closeModal()" class="button small">Close</button></div>
            </div>
            <div class="modal-resize-nw"></div>
            <div class="modal-resize-n"></div>
            <div class="modal-resize-ne"></div>
            <div class="modal-resize-e"></div>
            <div class="modal-resize-se"></div>
            <div class="modal-resize-s"></div>
            <div class="modal-resize-sw"></div>
            <div class="modal-resize-w"></div>
        </div>
        </div>

        <!-- Pop Up Modal -->

</body>
</html>