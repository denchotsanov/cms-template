var controllers = angular.module('controllers', []);

controllers.controller('MainController', ['$scope','$http', '$location', '$window',
    function ($scope, $http, $location, $window) {
        $scope.user = $window.user;


    }
]);