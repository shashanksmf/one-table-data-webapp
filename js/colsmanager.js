/* column manager class */
var colsManager=function(table){
    /* variables declaration */
    var _p;
    var maxCols=8;
    var colsArr=new Array('TowerId','SiteName','Address','City','County','Height','StructureClassification','TowerOwner');
    var allCols=new Array("TowerId","SiteName","Address","City","County","State","Zipcode","Latitude","Longitude","Height","StructureType","StructureClassification","FirstName","LastName","Phone","Email","Region","TowerOwner","BTANumber","MTANumber","MTAName","BTAName","NewSite","FCCNumber","TowerOwner_Short")
    var defaultColsArr=new Array({name:'TowerId',val:true},{name:'SiteName',val:true},{name:'Address',val:true},{name:'City',val:true},{name:'County',val:true},{name:'Height',val:true},{name:'StructureClassification',val:true},{name:'TowerOwner',val:true});
    var newCols=[];

    /* privates */
    _p={

        /* init and create hide/show columns menu, including events */
        buildShowHideColumns:function(clickcallback){
            var template="<ul class='list' id='ul-cols-list'>";
            var check="";
            $.each(allCols,function(i,col){
                    if($.inArray(col,colsArr)!=-1)
                        check="checked";
                    else
                        check="";
                    if(col=='TowerId')
                        template+='<li><i class="icon-tick"> </i> <label class="label"> '+col+' </label></li>';
                     //   template+='<li><input disabled id="" class="checkcols" name="'+col+'" type="checkbox" value="'+col+'" '+check+' >  <label class="label"> '+col+' </label></li>';

                    else
                        template+='<li><input id="" class="checkcols" name="'+col+'" type="checkbox" value="'+col+'" '+check+' >  <label class="label"> '+col+' </label></li>';
            })
            template +="</ul>"
            $('#block-cols-list').append(template);
            $('input.checkcols:checkbox:not(:checked)').disableInput()
            $('.checkcols').on('click',function(e){
                     _p.showHideCols($(this).val(),this.checked,clickcallback);
                    //insertToColsSlots($(this).val(),this.checked);

            })
        },

        /* process show/hide columns -------------------------------------------------------*/
        showHideCols:function(val,visible,clickcallback){
           //  if(==false)
                // return 0;
             var index=$.inArray(val,colsArr)
             if(index!=-1){
                table.DataTable().column(index).visible(visible);
                _p.updateSlots('update',index,val,visible);
             }
             else{
                if(visible==true){
                    newCols.push(val);
                }
                else{
                  var i=$.inArray(val,newCols)
                      newCols.splice(i, 1);
                }

             }

             _p.updateUI(visible)
             clickcallback(_p.visibles());

        },

        /* update slots accordingly since we only have 8 column slots */
        updateSlots:function(action,index,val,visible){
            if(action=='update'){
              defaultColsArr[index].val=visible;
            }

        },

       /* return the current columns, updated or new created
         perform also sorting so important columns are rendered first
       */
       cols:function(){
          var sortedCols=new Array();

             $.each(defaultColsArr,function(i,item){
                 if(item.val==true)
                    newCols.push(item.name)
             })
             $.each(allCols,function(i,item){
                  if($.inArray(item,newCols)!=-1)
                    sortedCols.push(item);

             })
           return sortedCols;
       },

       /* will just update the actuall menu if any changes */
       updateUI:function(insert){
          if(insert==true)
            if(_p.visibleLength()>=maxCols){
                  _p.messageAlert('Show/Hide Columns', 'Only '+maxCols+' columns are allowed,just unselect others',"right","top");
                  $('input.checkcols:checkbox:not(:checked)').disableInput();
                  return false;
            }
             else{
                    $('input.checkcols:checkbox:disabled').enableInput();
                    return true;
                }
             $('input.checkcols:checkbox:disabled').enableInput();
        },

        /* return the number of columns that are visible, since we always have 8 columns,
        but not neccesarrily always 8 that are visible */
        visibleLength:function(){
             var ctr=0;
             $.each(defaultColsArr,function(i,item){
                  if(item.val==true)
                    ctr++;
             })
             ctr=ctr+newCols.length;
             return ctr;
         },

         /* return the column names that are visible */
         visibles:function(){
             var visibles=[];
             $.each(defaultColsArr,function(i,item){
                  if(item.val==true)
                     visibles.push(item.name)
             })
             visibles=visibles.concat(newCols)
             return visibles;
         },

         messageAlert:function(title,body,hp,vp){
                notify(title,body,{ icon: 'img/helpericon.png',
                            hPos:hp,
                            vPos:vp
                        });
            }
    }
    /* public, these are just accessor functions basically to access the privates if needed
   . using return to be accesible publicly */
    return{
        buildShowHideColumns:function(clickcallback){
          _p.buildShowHideColumns(clickcallback);
        },
        cols:function(){
            return _p.cols();
        },
        refresh:function(fields){
            defaultColsArr=[];
            colsArr=newCols;
            $.each(newCols,function(i,item){
                  defaultColsArr.push({name:item,val:true})
            })
            newCols=[];
        }
    }
}
