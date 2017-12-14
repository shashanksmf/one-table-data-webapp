var app = angular.module('myApp', ['angular.filter', 'ngRoute']);

app.config(function ($routeProvider, $locationProvider) {
    // console.log($routeProvider)
    $locationProvider.hashPrefix('');
    $routeProvider
        .when("/:tableName", {
            controller: "myCtrl"
        })

    //   $locationProvider.html5Mode(true);

});
