app.controller('myCtrl', ['$scope','API',function ($scope,API) {
    console.log("API: ",API);
    $scope.uTableData = [];

    $scope.selectTable = function(tableName) {
        API.selectedTable(tableName).then(function(response){
            if (response.status == 200) {
                $scope.tableData = response.data.data;
            }
            else {
                alert("Please Try again Later "+ response.statusText);
            }
        })
    }

    API.getUtable().then(function(response){
        console.log("response",response);
        if(response.status == 200) {
            $scope.uTableData = response.data.data;
        }
        else {
            alert("Please Try again Later "+ response.statusText);
        }

    })
}]);