
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

    callAPI.updateRow = function(params){
        return $http({
            method: 'GET',
            url: baseHttpUrl + '/updateTableRow.php?' + params
        })
    }

    callAPI.deleteRow = function(params) {
        return $http({
            method: 'GET',
            url: baseHttpUrl + '/deleteTableRow.php?tableName='+params.tableName+'&id=' + params.id
        })
    }

    return callAPI;

 }]);