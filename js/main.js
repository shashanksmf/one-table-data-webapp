$(document).ready(function(){
    // cache elements for faster reaccess
    var decradius=$('#dec-radius');
    var declat=$('#dec-lat');
    var declng=$('#dec-lng');
    var mtadiv=$('#slc-mta');
    var btadiv=$('#slc-bta');
    var slcBta=$('#slc-bta');
    var asrfccnumber=$('#asrfcc-number');
    var sitename=$('#site-name');
    var sitenumber=$('#site-number');
    var tablediv = $('#table-list-view');
    var city=$('#city');
    var county=$('#county');
    var state=$('#state');
    var address=$('#address');
    var addrradius=$('#addr-dec-radius');
    var towerownerslatlng=$('#tower-owners-latlng');
    var towerownersaddress=$('#tower-owners-address');
    var towerownersname=$('#tower-owners-name');
    var towerownersmtabta=$('#tower-owners-mtabta');
    var towerowners=$('#tower-owners-');

    // dont include in filters sidebar
    var filtersExclude=new Array('Latitude',"Longitude","Address","SiteName","TowerId",'distance');
    // include in filters sidebar
    var filtersInclude=new Array('City','County','State','StructureClassification','TowerOwner');
    // dont include in table columns
    var tableFieldsExclude=new Array('Latitude',"Longitude",'distance');
    // other global vars
    var cols=new Array("TowerId","SiteName","Address","City","County","State","Zipcode","Latitude","Longitude","Height","StructureType","StructureClassification","FirstName","LastName","Phone","Email","Region","TowerOwner","BTANumber","MTANumber","MTAName","BTAName","NewSite","FCCNumber","TowerOwner_Short")
    var maxCols=8,GLAT,GLNG,
    table,
    detailsmodal,
    loadingmodal,
	tableStyled = false;
    var SEARCHTYPE='none';

    /* obj to store arrays of filters */
    var queryFilters={
        City:new Array(),
        County:new Array(),
        State:new Array(),
        StructureClassification:new Array(),
        TowerOwner: new Array()
    }

    var binginit=0;
    var bmapapp=new bMapApp('map-bing');
    var bingdata;
   // var prevColsSlotsState=colsSlots;
    var defaultColsArr=new Array('TowerId','SiteName','Address','City','County','Height','StructureClassification','TowerOwner');
    var defaultColHeads=new Array(
        {"data":'TowerId',"title":'TowerId'},
        {"data":'SiteName',"title":'SiteName'},
        {"data":'Address',"title":'Address'},
        {"data":'City',"title":'City'},
        {"data":'County',"title":'County'},
        {"data":'Height',"title":'Height'},
        {"data":'StructureClassification',"title":'StructureClassification'},
        {"data":'TowerOwner',"title":'TowerOwner'})

    /* initialization */
    initControls();
    initLatlngSearch();
    initMtaBtaSearch();
    initAddressSearch();
    initSiteNameSearch();

    populateTable([],defaultColHeads);


    /* main tab events */
    $('.tabs-content > div').on('showtab', function()
            {
              // refresh map , this is a fix for the google map clipping bug when
              // embeded  in tabs
              mapapp.refresh(true);
              bmapapp.refresh()
              if(this.id=='tab-map-bing' && binginit==0 ){
                          binginit=1;


              }

              if(this.id=='tab-map-bing'){
                   bmapapp.initMap();
                  bmapapp.deleteMarkers();
                  bmapapp.setMarkersDataSource(bingdata,
                        {
                        click:function(marker,data,category){
                            showDetails(data)
                        },
                            mouseout:function(marker,data,category){
                        }
                    }
                     );

                    bmapapp.showAllMarkers(true);
               }

    });

    /* initialize hide/show column menu */
    var colsMgr=new colsManager(table);
    colsMgr.buildShowHideColumns(showHideColClick);

    /* initialize google map */
    var mapapp= new gMapApp('map-google');
    mapapp.initMap();
    bmapapp.initMap();


    /*----------------------functions definations ------------------------------------*/

    /* since we will update/requery database every column change, we will just trigger
      the curresponding search buttons, no need to do its own search module
    */
    function showHideColClick(cols){
      if(SEARCHTYPE=='name')
        $('#btn-search-name').trigger('click')
      else if(SEARCHTYPE=='mtabta')
        $('#btn-search-mtabta').trigger('click')
      else if(SEARCHTYPE=='radius')
        $('#btn-search-latlng').trigger('click')
      else if(SEARCHTYPE=='address')
        $('#btn-search-address').trigger('click')
      else if(SEARCHTYPE=='addressradius')
        $('#btn-search-address').trigger('click')
      else{
          var defaultcols=[];
          $.each(cols,function(i,col){
             defaultcols.push(
             {"data":col,"title":col}
             )
          })
          populateTable([],defaultcols)
      }
    }

    /* callback for main search if success, which is also called for column hide/show events
      reinitialization of maps for both google and bing are performed here, previous markers
      are deleted and replace with new one. tables are also reinitialized and replace with
      new data
     --------------------------------------------*/
    function onSearchSuccess(data){

        var towers_data=$.parseJSON(data);
        bingdata=towers_data.mapdata;
        populateTable(towers_data.tabledata,buildTableHeadersData(towers_data.fields));
        colsMgr.refresh();
        mapapp.deleteMarkers();
        bmapapp.deleteMarkers();
        if(towers_data.tabledata.length>0){
        mapapp.setMarkersDataSource(towers_data.mapdata,
              {
                click:function(marker,data,category){
                  showDetails(data)
                  },
                mouseout:function(marker,data,category){
                  }
              }
          );
         bmapapp.setMarkersDataSource(towers_data.mapdata,
              {
                click:function(marker,data,category){
                  showDetails(data)
                  },
                mouseout:function(marker,data,category){
                  }
              }
          );

        mapapp.showAllMarkers(true);
        bmapapp.showAllMarkers(true);
        queryFilters.City=[];
        queryFilters.County=[];
        queryFilters.State=[];
        queryFilters.StructureClassification=[];
        queryFilters.TowerOwner=[]
            if(towers_data.counts){
                buildFilterMenu(towers_data.counts);
            }
            else{
                var filterdata=constructFilterData(towers_data);
                buildFilterMenu(filterdata);
            }

        }
        else{
           table.DataTable().column( 0 ).search('audel').draw();
           messageAlert('Search', 'Filtered search return zero results, please try different filter',"right","top")
        }
        loadingmodal.closeModal();
    }


     /* callback for filter search if success.
        filter search is called everytime user click in filters sidebar.
        reinitialization of maps for both google and bing are performed here, previous markers
      are deleted and replace with new one. tables are also reinitialized and replace with
      new data
     -----------------------------------------------------------------------------------*/
     function onFilterSearchSuccess(data){
        var towers_data=$.parseJSON(data);
        bingdata=towers_data.mapdata;
        mapapp.deleteMarkers();
        bmapapp.deleteMarkers();
        if(towers_data.tabledata.length>0){

              mapapp.setMarkersDataSource(towers_data.mapdata,
                    {
                      click:function(marker,data,category){
                        showDetails(data)
                        },
                      mouseout:function(marker,data,category){
                        }
                    }
                );
               bmapapp.setMarkersDataSource(towers_data.mapdata,
                    {
                      click:function(marker,data,category){
                        showDetails(data)
                        },
                      mouseout:function(marker,data,category){
                        }
                    }
                );

              populateTable(towers_data.tabledata,buildTableHeadersData(towers_data.fields))
              colsMgr.refresh();
              mapapp.showAllMarkers(true);
              bmapapp.showAllMarkers(true);

        }
        else{
           table.DataTable().column( 0 ).search('audel').draw();
           messageAlert('Search', 'Filtered search return zero results, please try different filter',"right","top")
        }
         loadingmodal.closeModal();
    }

    /* construct filter data for filters menu sidebar creation in ogranize matter through objects
    so we can update it easily everytime user check/uncheck filters. will be easy to use
    also in creation the actual menu/ui for filters
    . -------------------------*/
    function constructFilterData(data){
      var filterData={};

      $.each(filtersInclude,function(i,item){
        if($.inArray(item,filtersInclude)!=-1)
            filterData[item]={};
      })

      $.each(filterData,function(field,d){
            var temp1=new Array();
            var temp2={};
            $.each(data.tabledata,function(key,item){
                  if($.inArray(item[field],temp1)==-1){
                    queryFilters[field].push(item[field]);
                    temp1.push(item[field])
                    temp2[item[field]]={name:item[field],counter:1}
                  }
                  else{
                    temp2[item[field]].counter+=1;
                  }
            })

            filterData[field]=temp2;


      })
       return filterData;
    }

   /* the actuall function to build filter  menu in sidebar base on the cunstructed filter data
    ---------------------------------------------------*/
    function buildFilterMenu(filterData){
      var template="";
      var ctr=1;
      var close="";
      var display="style='display:none'"
      $.each(filterData,function(field,filter){

            close="closed";
            display="style='display:none'"
            if(ctr==1){
               close="";display="";
               }
            ctr++;
            template+='<dt class="'+close+'">'+
                       field+'</dt>'+
				        '<dd '+display+' ><div class="with-small-padding filter'+field+'"  >'+buildFilterMenuItem(filter,field)+
					     '</div></dd>';
      })
      $('#acd-filter-menu').empty();
      $('#acd-filter-menu').append(template);
      $('#acd-filter-menu').refreshAccordion()
      $('#acd-filter-menu').on('click','dt',function(e){

             if(!$(this).hasClass('closed')){
                 $(this).addClass('closed');
                 $(this).parent().children('dd').css('display','none');
                 e.stopPropagation()

             }

      })
    }

    /* create template for each item in filter menu sidebar ----------------------------*/
    function buildFilterMenuItem(items,field){
        var template=
         '<div class="blue-bg with-small-padding filterheader" ><input id="" checked class="checkbox" name="'+field+'" type="checkbox" value="'+field+'" > Check/Uncheck All</div>'+
        "<ul class='list' id='"+field+"'>";
        $.each(items,function(i,item){
                template+='<li><input id="" checked class="checkbox" name="'+item.name+'" type="checkbox" value="'+item.name+'" >  <label class="label"> '+item.name+' <span class="list-count">'+item.counter+'</span></label></li>';
        })
        return template +"</ul>";
    }


    /* build appropriate table data headers, to be use in table data option
       for initialization and reinitialazation. see tabledata initialiaztion in
       tabledata.net.
       we use the {data:data,title:'title'} object format for initialization
    ----------------------------------------------------------------------------------- */
    function buildTableHeadersData(fields){
      var headers=new Array();
      var ctr=0;
      $.each(fields,function(i,item){

         if(ctr>=maxCols)
           return false;
         if($.inArray(item,tableFieldsExclude)==-1){
            headers.push({"data":item,"title":item })
            ctr++;}
      })
      return headers;
    }

    /* init/re init and create data table
       see datatable docs in datatable.net for comprehensive information
     ------------------------------------------------------*/
    function populateTable(data,colheads){
      if(table){

        table.DataTable().destroy()
        tablediv.empty()
      }

      table=tablediv.dataTable({
		    "data": data,
            "columns":colheads,
			'aoColumnDefs': [
	  //			{ 'bSortable': false, 'aTargets': [ 0, 5 ] }
                    {
                      "targets": 0,
                      "createdCell": function (td, cellData, rowData, row, col) {
                    if(col==0){
                      $(td).html("<a href='javascript:void(0)' class='btn-tower-id' id='"+cellData+"' ><i class='icon-info-round'> </i> <B>" +cellData+"</ab></a>")

                    }
                    },
                    }
			],
			'sPaginationType': 'full_numbers',
			'sDom': '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
			'fnInitComplete': function( oSettings )
			{
				// Style length select
				tablediv.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
				tableStyled = true;
                tablediv.removeAttr('style')
			}
		});
   //     var table = $('#example').DataTable();
         var tt = new $.fn.dataTable.TableTools( table,{"sRowSelect": "multi"} );

         $( tt.fnContainer() ).insertAfter('div.showhidemenu');
         if(PROJECTINFO!=''){
                $('<a style="margin-top:11px" href="javascript:void(0)" class="button blue-gradient glossy" id="btn-add-to-project">Add selected entries to project.</a>').insertAfter('div.dataTables_length');
                 $('#btn-add-to-project').on('click',document,function(){
                   // console.log(tt.fnGetSelectedData());

                    saveToTPRJ(tt.fnGetSelectedData());

                 })

         }

    }
    /* save selected towers to tprj ste */
    function saveToTPRJ(data){
          if(data.length==0)
            return 0;
          var frmdata={
            towerids:'',
            ProjInfo: PROJECTINFO
          };
          var tempstr='';
          $.each(data,function(i,item){
                tempstr +=item.TowerId+':';
          })
          frmdata.towerids=tempstr;
          var dataString=$.param(frmdata);
          $.ajax({type:'GET',data:dataString,url:"updatetprj.php",success:onTPRJSuccess});
    }
    function onTPRJSuccess(data){
      var r=$.parseJSON(data)
       if(r.result==1)
            messageAlert('Save', 'Items saved to project :) ',"right","top");
       else
            messageAlert('Save', 'Error saving',"right","top");

    }

    /* show tower details in modal window
       a popup window for towerdetails
    ----------------------------------------------*/
    function showDetails(pdata){
       var formurl='towerdetails.php';
       var dataString=$.param({towerid:pdata.towerid});
       detailsmodal=$.modal({
                onClose:function(){doom_insert_ctr=0;iscancel=false;},
                onOpen:function(){
                },
				contentBg:true,
				classes:'',
				blocker:true,
                url: formurl,
   				resize:false,
                width:600,
 				height:450,
                ajax: { data:dataString,type:"GET",loadingMessage:'<div style="width:100%;;height:150px;background-color:#fff;display:block;text-align:center"><BR><BR><BR><span class="loader working"></div>'},
				scrolling:false,
				buttonsLowPadding: true,
				buttons: {
					'Close': {
						classes :	'small',
						click :	     function(modal) { detailsmodal.closeModal();;
                           }
					}
				},
				});
              detailsmodal.ajaxComplete(function( event, xhr, settings ) {
                var latlngstr=$('div.modal input.details-latlng').val();
                showDetailMaps(latlngstr.split(':'))
              })
    }
     /* function to init/show maps in tower details popup */
    function showDetailMaps(latlng){
           var gmap=new gMapApp('details_gmap');
           var json={"data":"","id":"","icon":"img\/cell_id.png","latlng":latlng};
           gmap.initMap({zoom:15,latlng:latlng});
           gmap.setMarkersDataSource(new Array(json),{})
           gmap.showAllMarkers(false);
           var bmap=new bMapApp('details_bmap');
           bmap.initMap({zoom:15,latlng:latlng});
           bmap.setMarkersDataSource(new Array(json),{})
           bmap.showAllMarkers();
            $('#details-tabs-content > div').on('showtab', function()
            {
                gmap.refresh(false);
                gmap.setCenter(latlng);
            });

    }



    /* initialize address search, called in main search menu as well as
      the hide/show column click event .
      perform ajax call to query database
    ----------------------------------------------------------------*/
    function initAddressSearch(){
      $('#btn-search-address').on('click',function(e){
        openLoadingModal()
        SEARCHTYPE='addressradius';
        var faddress=address.val()==""?"":address.val() +",";
            faddress+=city.val()==""?"":city.val() +",";
            faddress+=county.val()==""?"":county.val() +",";
            faddress+=state.val()==""?"":state.val() +",";
            if(address.val().trim()=="" && addrradius.val().trim()==""){
               SEARCHTYPE='address';
               var frmdata={
                            faddress:address.val(),
                            fcity:city.val(),
                            fcounty:county.val(),
                            fstate:state.val(),
                            towerowners:towerownersaddress.val(),
                            searchtype:'address',
                            ajax:1,
                            cols:colsMgr.cols().join(':')
                        }
                        var dataString=$.param(frmdata);
                       $.ajax({type:'GET',data:dataString,url:"ajaxsearch.php",success:onSearchSuccess});
            }
            else{
                  if(addrradius.val().trim()=="")
                    var r=5;
                  else
                    var r=addrradius.val();
                  var p=mapapp.geocode(faddress);
                  p.done(function(data){
                    GLAT=  data.latlng[0];GLNG=data.latlng[1]
                              var frmdata={
                                  radius:r,
                                  lat:GLAT,
                                  lng:GLNG,
                                  searchtype:'radius',
                                  towerowners:towerownersaddress.val(),
                                  ajax:1,
                                  cols:colsMgr.cols().join(':')
                              }
                              var dataString=$.param(frmdata);
                              $.ajax({type:'GET',data:dataString,url:"ajaxsearch.php",success:onSearchSuccess});
                  })
                  p.fail(function(err){
                     messageAlert('Search', 'Error geocoding address: '+faddress,"right","top")
                  })
            }

        })
    }



    /*  initialize latitude longitude search, called in main search menu as well as
      the hide/show column click event.
      perform ajax call to query database
       ------------------------------------------------------*/
    function initLatlngSearch(){

        $('#btn-search-latlng').on('click',function(e){
            openLoadingModal()
              SEARCHTYPE='radius';
             var frmdata={
                            radius:decradius.val(),
                            lat:declat.val(),
                            lng:declng.val(),
                            searchtype:'radius',
                            ajax:1,
                            towerowners:towerownerslatlng.val(),
                            cols:colsMgr.cols().join(':')
                        }
                        var dataString=$.param(frmdata);
                        $.ajax({type:'GET',data:dataString,url:"ajaxsearch.php",success:onSearchSuccess});
        })
    }


    /*  initialize mta bta search , called in main search menu as well as
      the hide/show column click event.
      perform ajax call to query database
       ------------------------------------------------------*/
    function initMtaBtaSearch(){
        $('#btn-search-mtabta').on('click',function(e){
           openLoadingModal();
           SEARCHTYPE='mtabta';
             var frmdata={
                            mta:mtadiv.val(),
                            bta:btadiv.val(),
                            searchtype:'mtabta',
                            ajax:1,
                            towerowners:towerownersmtabta.val(),
                            cols:colsMgr.cols().join(':')
                        }
                        var dataString=$.param(frmdata);
                       $.ajax({type:'GET',data:dataString,url:"ajaxsearch.php",success:onSearchSuccess});
        });
    }

     /*  initialize sitename,towerid,fcc search, called in main search menu as well as
      the hide/show column click event.
      perform ajax call to query database
       ------------------------------------------------------*/
    function initSiteNameSearch(){
        $('#btn-search-name').on('click',function(e){
           openLoadingModal()
           SEARCHTYPE='name';
             var frmdata={
                            fccnumber:asrfccnumber.val(),
                            sitename:sitename.val(),
                            towerid:sitenumber.val(),
                            searchtype:'name',
                            ajax:1,
                            towerowners:towerownersname.val(),
                            cols:colsMgr.cols().join(':')
                        }
                        var dataString=$.param(frmdata);
                       $.ajax({type:'GET',data:dataString,url:"ajaxsearch.php",success:onSearchSuccess});
        });
    }


    /* actuall function for fitler search
      perform ajax call to query database
     -------------------------------------------------------------------*/
    function filterSearch(){
        openLoadingModal()
        var flat=declat.val();
        var flng=declng.val();
        if(SEARCHTYPE=='address'){
           flat=GLAT;
           flng=GLNG;
           towerowners=towerownersaddress.val()
        }
        else if(SEARCHTYPE=='radius'){
          towerowners=towerownerslatlng.val()
        }
        else if(SEARCHTYPE=='name'){
          towerowners=towerownersname.val()
        }
        else if(SEARCHTYPE=='mtabta'){
          towerowners=towerownersmtabta.val()
        }
             var frmdata={
                            faddress:address.val(),
                            fcity:city.val(),
                            fcounty:county.val(),
                            fstate:state.val(),
                            fccnumber:asrfccnumber.val(),
                            sitename:sitename.val(),
                            towerid:sitenumber.val(),
                            radius:decradius.val(),
                            lat:flat,
                            lng:flng,
                            mta:mtadiv.val(),
                            bta:btadiv.val(),
                            searchtype:SEARCHTYPE,
                            ajax:1,
                            towerowners:towerowners,
                            City:queryFilters.City.join(":"),
                            County:queryFilters.County.join(":"),
                            State:queryFilters.State.join(":"),
                            StructureClassification: queryFilters.StructureClassification.join(":"),
                            TowerOwner: queryFilters.TowerOwner.join(":"),
                            cols:colsMgr.cols().join(':')

                        }
                        var dataString=$.param(frmdata);
                        $.ajax({
                                    type:'GET',
                                    data:dataString,
                                    url:"ajaxsearchfilter.php",
                                    success:onFilterSearchSuccess
                                });
    }



    /* other elements like buttons,textboxes,fields events initialization
     -----------------------------------------*/
    function initControls(){
      $("#frm-search-latlng").validationEngine();
      $("#table-list-view").on('click','td .btn-tower-id',function(e){
            var tag=$('#colvisopts').css('display')
            if(tag!='none'){
            var id=$(this).attr('id');
            showDetails({'towerid':id});
            }
      })
      $('#acd-filter-menu').on('click','dd div.filterheader .checkbox',function(e){
          var field=$(this).children('input').attr('name');
          var list=$("dd #"+field +" li");
          var check=false;
            if($(this).hasClass('checked'))
                 check=true;
           if(check==true){
              queryFilters[field]=[];
              list.each(function(i,li){
                  var item=$(li);
                  item.children(".checkbox").removeClass("checked");
                  item.children(".checkbox").children('input').prop('checked',false)
              })
           }
           else{
              list.each(function(i,li){
                   var item=$(li);
                   item.children(".checkbox").addClass("checked");
                   item.children(".checkbox").children('input').prop('checked',true);
                   queryFilters[field].push(item.children(".checkbox").children('input').val());
              })
           }
           filterSearch();
      });
      $('#acd-filter-menu').on('click','ul li .checkbox',function(e){
             var field=$(this).parent().parent().attr('id');
             var check=false;
             if($(this).hasClass('checked'))
                      check=true;
             var val=this.lastChild.value;
             var index=$.inArray(val,queryFilters[field]);
             if(index==-1){
                queryFilters[field].push(val)
             }
             else{
                queryFilters[field].splice(index, 1);
             }
             filterSearch();
            // console.log(queryFilters)
            // table.DataTable().column( 3 ).search('(anchorage)|(ft. richardson)',true).draw();
      })

      $('#btn-search-type').menuTooltip($('#block-search-type'));

      $('#btn-show-hide-cols').menuTooltip($('#block-cols-list'))

      $('#slc-search-type').on('change',function(e){
        var type=$('#slc-search-type').val();
        $('#frm-search-latlng').hide();
        $('#frm-search-mtabta').hide()
        $('#frm-search-address').hide();
        $('#frm-search-site').hide();
        if(type==1)
            $('#frm-search-latlng').show();
        else if(type==2)
             $('#frm-search-mtabta').show();
        else if(type==3)
            $('#frm-search-address').show();
        else if(type==4)
            $('#frm-search-site').show();

      })

      $('#slc-mta').on('change',function(e){
            var key=$(this).val();
            slcBta.empty();
            if(key=='none'){
               var temp= "<option value='none' >BTA Name</option>" ;
               slcBta.append(temp);
               slcBta.trigger('update-select-list');
               return 0;
               }

            $.each(MTABTAOBJECTS[key],function(i,item){
                  var temp= "<option value='"+item[0]+"' >"+item[0] +'('+item[1]+")</option>" ;
                  slcBta.append(temp)
            })
            slcBta.trigger('update-select-list');
      })

      $('#open-menu').on('click',function(e){
            if($('body').hasClass('menu-hidden')){
               $('#main-search-wrapper').css('padding-right','20px');
            }
            else
                $('#main-search-wrapper').css('padding-right','0px');
      })


    }



    /* notifications function */
    function messageAlert(title,body,hp,vp){
        notify(title,body,{ icon: 'img/helpericon.png',
                            hPos:hp,
                            vPos:vp
                        });
    }

    /* loading modal everytime theres ajax call to server

     */
    function openLoadingModal()
		{
		  loadingmodal=$.modal({
				contentAlign: 'center',
				width: 240,
                classes:'modalposition',
				title:false,
				content: '<span class="loader working"></span> <span id="modal-status">Contacting server.. :)</span>',
				buttons: {},
				scrolling: false,
				actions: false,
			});
          loadingmodal.setModalPosition(10,10)
		}
})
