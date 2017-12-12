/* bing map class */
var bMapApp=function(tdiv){
  /* local variables */
  var _p,
        map,
        d_latlng=new Array(37.9,-77),
        d_zoom=4,
        cache_markers=new Array(),
        cache_popups=new Array(),
        latlngs=new Array(),
        infobox,
        mapdiv,
        markers_json_data,
        MAPKEY='AjtUzWJBHlI3Ma_Ke6Qv2fGRXEs0ua5hUQi54ECwfXTiWsitll4AkETZDihjcfeI',
  //      MAPKEY='AhBj-5rcu5auVcAPDeZQi6EgPOcC8vQfXqk7B5uMrA9-PAe_c_wWqfB8g8caxx1B',
        geocoder;
  /* privates */
  _p={  /* initialized map */
        initMap: function(opts){
            var dlatlng=opts?(opts.latlng?opts.latlng:d_latlng):d_latlng
            var mapOptions = {
                credentials:MAPKEY,
                zoom: opts?(opts.zoom?opts.zoom:d_zoom):d_zoom,
                mapTypeId:Microsoft.Maps.MapTypeId.road,
                center: new Microsoft.Maps.Location(dlatlng[0], dlatlng[1])
            };
            map = new Microsoft.Maps.Map(document.getElementById(tdiv),mapOptions);
        },

         /* store markers datasource */
        setMarkersDataSource:function(dts,params){
            if(dts instanceof Array)
               markers_json_data=dts;
            else if(dts instanceof String)
               markers_json_data='';  // do some ajaxcalls for datasource

            else
               markers_json_data=null;
            ;
            _p.generateMarkers(markers_json_data,params);
        },
        /* generate markers and its click event,
     and save to cache, doesnt added to map yet */
        generateMarkers:function(arr,params){
            latlngs=[];
            $.each(arr,function(index,item){
                  var options={};
                  var cat,id;
                  if(item.icon){
                    options={
                        icon: item.icon
                    };
                  }
                  else
                    options={};
                  item.category ? cat=item.category :  cat='marker';
                  item.id ? id=item.id : id = _p.generateId();

                  var l=new Microsoft.Maps.Location(item.latlng[0],item.latlng[1]);
                  var newmarker = new Microsoft.Maps.Pushpin(l,options);
                  newmarker.externalid=id;
                  Microsoft.Maps.Events.addHandler(newmarker, 'click', function() {
                       if(params.click){
                          params.click(this,item.data,item.category);
                    }
                  })
                   Microsoft.Maps.Events.addHandler(newmarker, 'mouseover', function() {
                       if(params.mouseover){
                          params.mouseover(this,item.data,item.category);
                    }
                  })
  //                newmarker.showInfoWindow=_p.showInfoWindow
                  cache_markers.push({
                        id: id,
                        parentid:0,
                        category:cat,
                        marker:newmarker}
                  );
                  latlngs.push(l)
             })
        },
        /* show/hide all markers */
        showAllMarkers:function(autofit){
              $.each(cache_markers,function(index,marker){
                    if(marker)
                       map.entities.push(marker.marker);
                    else
                        map.entities.removeAt( map.entities.indexOf(marker.marker))
              })
             // if(autofit==true)
               // setTimeout( _p.autoFit(latlngs) ,500);
                _p.autoFit(latlngs)

        },

        /* autofit markers in map */
        autoFit:function(latlngs){
               map.setView({bounds: Microsoft.Maps.LocationRect.fromLocations(latlngs),padding:10});
        },

         /* fix for bing map clipping bug when embedded in tabs */
        refresh:function(){
             map.setView({zoom:8});
            _p.autoFit(latlngs);
        },

         /* random id generator */
        generateId:function(){
            return (Math.random() * (999999 - 10000) + 10000);
        },

        /* delete/ remove markers from map and cache */
        deleteMarkers:function(){
          /* $.each(cache_markers,function(index,marker){
                  map.entities.removeAt( map.entities.indexOf(marker.marker))
            })
            */
            map.entities.clear();
            cache_markers=[]
        },
    }

    /* public, these are just accessor functions basically to access the privates if needed
   . using return to be accesible publicly */
    return{
       initMap: function(opts){
            _p.initMap(opts);
       },

       setMarkersDataSource:function(dts,params){
            if(map)
                _p.setMarkersDataSource(dts,params);
       },
       showAllMarkers:function(autofit){
            if(!autofit)
                autofit=false;
            if(map)
            _p.showAllMarkers(autofit);
        },
       refresh:function(){
            if(map)
            _p.refresh();
       },
       deleteMarkers:function(){
            if(map)
            _p.deleteMarkers();
       },
       setZoom:function(z){
         map.setView({zoom:z});
       }

    }
}