/* google map class */
var gMapApp=function(tdiv){
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
        geocoder;
        geocoder = new google.maps.Geocoder();

  /* privates */
  _p={
    /* initialized map */
        initMap: function(opts){
            var dlatlng=opts?(opts.latlng?opts.latlng:d_latlng):d_latlng
            var mapOptions = {
                zoom: opts?(opts.zoom?opts.zoom:d_zoom):d_zoom,
                center: new google.maps.LatLng(dlatlng[0], dlatlng[1])
            };
            map = new google.maps.Map(document.getElementById(tdiv),mapOptions);
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
                    options.icon={
                        url: item.icon ,
                        origin: new google.maps.Point(0,0),
                        anchor: new google.maps.Point(0, 0)
                    };
                  }
                  else
                    options.icon={};
                  item.category ? cat=item.category :  cat='marker';
                  item.id ? id=item.id : id = _p.generateId();

                   var l=new google.maps.LatLng(item.latlng[0],item.latlng[1]);
                   var newmarker = new google.maps.Marker({
                        position:l ,
                        icon:options.icon
                    });
                  newmarker.externalid=id;

                  /* marker events */
                  google.maps.event.addListener(newmarker, 'click', function() {
                       if(params.click){
                          params.click(this,item.data,item.category);
                    }
                  })
                  google.maps.event.addListener(newmarker, 'mouseover', function() {
                       if(params.mouseover){
                          params.mouseover(this,item.data,item.category);
                    }
                  })
                 /* store to cache */
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
                        marker.marker.setMap(map);
                    else
                        marker.marker.setMap(null);
              })
              if(autofit==true)
                 _p.autoFit(latlngs)

        },

        /* autofit markers in map */
        autoFit:function(latlngs){
              var bounds = new google.maps.LatLngBounds ();
              for (var i = 0, LtLgLen = latlngs.length; i < LtLgLen; i++) {
                  bounds.extend (latlngs[i]);
              }
              map.fitBounds (bounds);
        },

        /* fix for google map clipping bug when embedded in tabs */
        refresh:function(autofit){
              google.maps.event.trigger(map, 'resize');
              if(autofit==true)
                _p.autoFit(latlngs);
        },

        /* random id generator */
        generateId:function(){
            return (Math.random() * (999999 - 10000) + 10000);
        },

        /* delete/ remove markers from map and cache */
        deleteMarkers:function(){
           $.each(cache_markers,function(index,marker){
                   marker.marker.setMap(null)
            })
            cache_markers=[]
        },


        /* geocoding function , using google map geocoding service */
        geocode:function(address) {
             var D=$.Deferred();
              geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var lng=(results[0].geometry.location.B?results[0].geometry.location.B:results[0].geometry.location.A)
                        var latlngarr=new Array(results[0].geometry.location.k,lng);
                        D.resolve({latlng:latlngarr})
                    } else {
                        D.reject('whoops error in geocoding ' + status)
                    }
                });
              return D.promise();
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
       refresh:function(autofit){
         if(!autofit)
                autofit=false;
            if(map)
            _p.refresh(autofit);
       },
       deleteMarkers:function(){
            if(map)
            _p.deleteMarkers();
       },
       geocode:function(address){

            return _p.geocode(address);
       },
       setZoom:function(z){
         map.setZoom(z)
       },
       setCenter:function(latlng){
         map.setCenter(new google.maps.LatLng(latlng[0],latlng[1]))
       }

    }
}
