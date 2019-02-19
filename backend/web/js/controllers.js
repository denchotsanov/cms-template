var controllers = angular.module('controllers', ['ngAnimate', 'ngSanitize', 'ui.bootstrap']);

controllers.controller('MainController', ['$scope','$http', '$location', '$window',
    function ($scope, $http, $location, $window) {
        $scope.user = $window.user;


    }
]);