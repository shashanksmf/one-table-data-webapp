app.controller('myCtrl', ['$scope', 'API', '$location', '$routeParams','$route','$timeout', function ($scope, API, $location, $routeParams,$route,$timeout) {
    $scope.uTableData = [], $scope.selectedTableName, $scope.sortType = "", $scope.filterObj = {}, $scope.filterData = []; 
    $scope.filterFields = [];
    $scope.urlRoute = $route;
    $scope.showModal = false;
    var editableFields = { 'st': 'site_id', 'tracker':'Request_Date' };
    var filterData = [];
    $scope.sumArr = [];

    $scope.selectTable = function(tableName) {
        $location.path("/utable&data=" + tableName);
        $scope.selectedTableName = tableName;
        API.selectedTable(tableName).then(function(response){
            if (response.status == 200) {
                $scope.selectedTableData = response.data.data; 
                
                for (var l = 0; l < $scope.uTableData.length; l++) {
                    if ($scope.uTableData[l].db_tb == $scope.selectedTableName && $scope.uTableData[l].sum == 'Yes') {
                        $scope.sumArr.push({ "key": $scope.uTableData[l].field, "total": 0 });
                    }
                }

                for (var k = 0; k < $scope.selectedTableData.length;k++) {
                    $scope.selectedTableData[k].isFilter = true;
                    for (var m = 0; m < $scope.sumArr.length;m++) {
                       console.log($scope.sumArr[m].key, $scope.selectedTableData[k]);
                        if ($scope.selectedTableData[k][$scope.sumArr[m].key] && !isNaN($scope.selectedTableData[k][$scope.sumArr[m].key])) {
                           // console.log($scope.selectedTableData[k][sumArr[m].field])
                            $scope.sumArr[m].total += Number($scope.selectedTableData[k][$scope.sumArr[m].key]);
                        }
                    }
                }
                console.log("sumarr",$scope.sumArr);
                $scope.filterFields = _.filter($scope.uTableData, { 'db_tb': $scope.selectedTableName, 'filter': 'Yes' })
                var filterData = [];
                for (var i = 0; i < $scope.filterFields.length;i++) {
                    var filterArr = []; 
                    for(var j=0;j<$scope.selectedTableData.length;j++) {
                        if ($scope.selectedTableData[j][$scope.filterFields[i].name]) {
                            filterArr.push({ checked: true, value: $scope.selectedTableData[j][$scope.filterFields[i].name] });
                        }
                    }
                    filterData.push({ key: $scope.filterFields[i].name, val: _.uniqWith(filterArr, _.isEqual) , checkAll:true });
                }
                $scope.filterData = filterData;
             
               

            }
            else {
                alert("Please Try again Later "+ response.statusText);
            }
        })
    }

    API.getUtable().then(function(response){
     //   console.log("response",response);
        if(response.status == 200) {
            $scope.uTableData = response.data.data;
            
        }
        else {
            alert("Please Try again Later "+ response.statusText);
        }

    })

    $scope.checkWeb = function(params){
    //   console.log(params)
        if (_.find) {
            var lodObj = _.find($scope.uTableData, { 'db_tb': $scope.selectedTableName, 'name': params.trim().replace("_"," ").trim(), 'web': 'Yes' });
            //var lodObj = _.find($scope.uTableData, { 'db_tb': $scope.selectedTableName, 'field': params.trim(), 'web': 'Yes' });
            return lodObj ? 1 : 0;
        } else {
            return 0;
        }
    }

    $scope.sort = function(name){
        $scope.sortType = name;
    }

    $scope.filterTable = function(key,value,status) { 
        for(var i=0; i < $scope.selectedTableData.length; i++) {
            if ($scope.selectedTableData[i][key] == value) {
                $scope.selectedTableData[i].isFilter = status;
            }
        }   
    }

    $scope.filterCheckAll = function (index, columnName,status){
        $scope.filterData[index].val.forEach(function(item){
            item.checked = status;
            $scope.filterTable(columnName,item.value,status);
        })
    }

    $scope.editSelectedData = function(item,index){
        //console.log(item);
     //   alert(index);
       // return;
        $scope.editItemIndex = index;
        $scope.editData = item;
        $scope.showModal = true;
    }

    $scope.isEditable = function(fieldName,tableName){
        if(editableFields[tableName] == fieldName) {
            return true;
        }
        return false;
    }

    $scope.updateRow = function(tableObj){
        var selectedTableObj = tableObj;
        selectedTableObj.tableName = $scope.selectedTableName;
        //console.log("update table", tableObj)
        delete selectedTableObj["$$hashKey"];
        delete selectedTableObj["isFilter"];
        var strParams = "";
        for (var key in selectedTableObj) {
            strParams += key + '=' + selectedTableObj[key] + '&';
        }
        API.updateRow(strParams).then(function(response){
            console.log("response",response);
            if (response.data.hasOwnProperty("error") && response.data.error) {
                alert(response.data.msg);
            }else {
                alert(response.data.msg);
            }
        })
    }

    $scope.closeModal = function(){
        $scope.showModal = false;
    }

    $scope.checkIfVisible = function(param) {
        if(param == 'id' || param == 'isFilter') {
            return false;
        }
        return true;
    }

    $scope.deleteRow = function(params,index){
        var tb_id;
        if($scope.selectedTableName == 'tracker') {
            tb_id = params.id;
            API.deleteRow( { id: params.id, tableName: $scope.selectedTableName }).then(function(response){
                if (response.data.hasOwnProperty("error") && response.data.error) {
                 //   alert(response.data.msg);
                  
                } else {
                    $scope.selectedTableData.splice($scope.editItemIndex, 1);
                    alert(response.data.msg);
                    $scope.showModal = false;
                }
                
            });
            return;
        }
        alert("No Id for this table");
    }

    $scope.ifSum = function(field){
        for (var i = 0; i < $scope.sumArr.length; i++) {
            if ($scope.sumArr[i].key.toLowerCase() == field.toLowerCase()) {
                return true;
            }
        }
        return false;
    }

    $scope.getSum = function(field){
        console.log($scope.sumArr)
        for (var i = 0; i < $scope.sumArr.length; i++) {
            if ($scope.sumArr[i].key.toLowerCase() == field.toLowerCase()) {
                return $scope.sumArr[i].total;
            }
        }
        return false;
    }

}]);