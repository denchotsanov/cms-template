app.controller('MainController', function ($scope,$timeout,$http,$window) {
    $scope.user = {};

    $timeout(function () {

        $scope.user = $window.user;

    },0);


});