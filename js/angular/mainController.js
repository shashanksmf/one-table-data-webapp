app.controller('myCtrl', ['$scope', 'API', '$location', '$routeParams','$route','$timeout', function ($scope, API, $location, $routeParams,$route,$timeout) {
    $scope.uTableData = [], $scope.selectedTableName, $scope.sortType = "", $scope.filterObj = {}, $scope.filterData = []; 
    $scope.filterFields = [];
    $scope.urlRoute = $route;
    
    var filterData = [];

    $scope.selectTable = function(tableName) {
        $location.path("/utable&data=" + tableName);
        $scope.selectedTableName = tableName;
        API.selectedTable(tableName).then(function(response){
            if (response.status == 200) {
                $scope.selectedTableData = response.data.data; 
                
                for (var k = 0; k < $scope.selectedTableData.length;k++) {
                    $scope.selectedTableData[k].isFilter = true;
                }
              
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
                console.log($scope.selectedTableData);
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
        console.log(params, $scope.selectedTableName,$scope.uTableData)
        if (_.find) {
            var lodObj = _.find($scope.uTableData, { 'db_tb': $scope.selectedTableName, 'name': params.trim().replace("_"," ").trim(), 'web': 'Yes' });
          //  console.log(lodObj)
            return lodObj ? 1 : 0;
        } else {
            return 0;
        }
        //return params;
    }

    $scope.sort = function(name){
        $scope.sortType = name;
    }

    $scope.filterTable = function(key,value,status) { 
      //  console.log(key,value,status);
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

}]);