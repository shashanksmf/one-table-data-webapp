<!DOCTYPE html>
<!--[if IEMobile 7]>
<html class="no-js iem7 oldie">
   <![endif]-->
   <!--[if (IE 7)&!(IEMobile)]>
   <html class="no-js ie7 oldie" lang="en">
      <![endif]-->
      <!--[if (IE 8)&!(IEMobile)]>
      <html class="no-js ie8 oldie" lang="en">
         <![endif]-->
         <!--[if (IE 9)&!(IEMobile)]>
         <html class="no-js ie9" lang="en">
            <![endif]-->
            <!--[if (gt IE 9)|(gt IEMobile 7)]><!-->
            <html class="no-js" lang="en">
               <!--<![endif]-->
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
               <body class="clearfix with-menu" ng-app="myApp" ng-controller="myCtrl">
                  <!-- Prompt IE 6 users to install Chrome Frame -->
                  <!--[if lt IE 7]>
                  <p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
                  <![endif]-->
                  <!-- Button to open/hide menu -->
                  <a href="#" id="open-menu"><span>Menu</span></a>
                  <!-- Main content -->
                  <section role="main" id="main">
                     <!-- Visible only to browsers without javascript -->
                     <noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>
                     <!-- Main title -->
                     <!-- The padding wrapper may be omitted -->
                     <div class="with-padding">
                        <!-- Wrapper, set tabs style class here -->
                        <div class="standard-tabs">
                           <!-- Tabs -->
                           <ul class="tabs">
                              <li class="active"><a href="#list_view" class='with-med-padding' style="padding-bottom:12px;padding-top:12px"><i class="icon-list icon-size2"> </i> List Liew</a></li>
                              <li><a href="#map_view" class='with-med-padding' style="padding-bottom:12px;padding-top:12px"><i class="icon-marker icon-size2"> </i> Map View</a></li>
                              
                           </ul>
                           <ul class="UTableDropDown">
                                <li ng-repeat="tableObj in uTableData  | unique:'table'" ng-click="selectTable(tableObj.db_tb)">{{tableObj.table}}</li>
                           </ul>
                           <!-- Content -->
                           <div class="tabs-content">
                              <div id="list_view"  style='padding:5px 20px 20px 20px'>
                                 <div class="colvisopts with-small-padding" id="colvisopts">
                                    <div class="showhidemenu" style='width:200px;display:inline-block'>
                                       <a href="javascript:void(0)" class="button blue-gradient glossy" id="btn-show-hide-cols">Show/Hide Columns</a>
                                       <div id='block-cols-list'>

                                          <!-- <center><a href="javascript:void(0)" class="button compact blue-gradient">Update Results</a></center>-->
                                       </div>
                                    </div>
                                    <div class='float-right' style="margin-right:10px;padding-top:5px"><small>In printing mode, click "ESC" in keyboard to go back in main page</small></div>
                                 </div>sortType/{{sortType}}
                                 <table class="table responsive-table responsive-table-on" id="table-list-view" >
                                        <thead ng-if="$index == 0" ng-repeat="tableObj in selectedTableData">

                                            <tr>{{tableObj}}
                                                <td ng-repeat="(key,value) in tableObj"  ng-click="sort(key)" ng-if="checkWeb(key)">{{key}}</td>
                                            </tr>
                                        </thead>

                                        <tbody >
                                            <tr ng-repeat="tableObj in selectedTableData | orderBy:sortType:false">
                                                <td ng-if="checkWeb(key)" ng-repeat="(key,value) in tableObj">{{value}}</td>
                                            </tr>
                                        </tbody>
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
                            <div ng-repeat="(key,value) in selectedTableData">
                                <div ng-repeat="filter in filterFields">{{value[filter.name]}}</div>
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
                <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
                <script src="js/libs/lodash.min.js"> </script>
                <script src="js/angular/angular-filter.min.js"></script>
                <script src ="js/angular/API.js"></script>
                <script src="js/angular/mainController.js"></script>
               
               </body>
            </html>