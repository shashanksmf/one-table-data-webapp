app.controller('myCtrl', ['$scope', 'API', '$location', '$routeParams','$route', function ($scope, API, $location, $routeParams,$route) {
   $scope.uTableData = [], $scope.selectedTableName, $scope.sortType = "", $scope.filterData = [];
    $scope.filterFields = [];
    $scope.urlRoute = $route;
    $scope.$watch('urlRoute',function(oldval,newVal){
        console.log(oldval,newVal);
    }) 
    var filterData = [];

    $scope.selectTable = function(tableName) {
        $location.path("/utable&data=" + tableName);
        $scope.selectedTableName = tableName;
        API.selectedTable(tableName).then(function(response){
            if (response.status == 200) {
                $scope.selectedTableData = response.data.data;
                $scope.filterFields = _.filter($scope.uTableData, { 'db_tb': $scope.selectedTableName, 'filter': 'Yes' })
            }
            else {
                alert("Please Try again Later "+ response.statusText);
            }
        })
    }

    // var routeParam = $route.current.param.split("=")[1];
    // if(routeParam && routeParam.length > 0) {
    //     $scope.selectTable(routeParam);
    // }

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
        console.log(params.trim().replace("_", " ").trim(), "-", $scope.selectedTableName, $scope.uTableData);
        if (_.find) {
            var lodObj = _.find($scope.uTableData, { 'db_tb': $scope.selectedTableName, 'name': params.trim().replace("_"," ").trim(), 'web': 'Yes' });
            console.log(lodObj)
            return lodObj ? 1 : 0;
        } else {
            return 0;
        }
        //return params;
    }

    $scope.sort = function(name){
      //  console.log(name);
        $scope.sortType = name;
    }

}]);