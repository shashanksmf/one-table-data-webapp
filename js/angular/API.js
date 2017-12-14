
app.factory('API', ['$http', '$q', function ($http, $q) {
    var callAPI = {}, baseHttpUrl = "./API"; 
    
    callAPI.getUtable = function () {
        return $http({
            method: 'GET',
            url: baseHttpUrl + '/GetUTable.php'
        })
    }

    callAPI.selectedTable = function (tableName) {
        return $http({
            method: 'GET',
            url: baseHttpUrl + '/getSelectedTable.php?tableName='+tableName
        })
    }

    return callAPI;

 }]);