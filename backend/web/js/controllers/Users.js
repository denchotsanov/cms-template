app.controller('UsersController', function ($scope,$timeout,$http,$window,$modal,$log) {

    $scope.openPopup = function () {
        var modal = $modal.open({
            templateUrl: webroot + '/user/create',

            size: 'lg'

        });
    };

    $scope.close = function () {
        var modal = $modal.cancel();
    }
});