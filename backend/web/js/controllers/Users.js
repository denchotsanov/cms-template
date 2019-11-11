app.controller('UsersController', function ($scope, $timeout, $window, $uibModal) {
    $scope.openPopup = function () {
        $uibModal.open({
            controller: 'CreateUserController',
            templateUrl: webroot + '/user/create',
            parent: angular.element(document.body),
            clickOutsideToClose: false,
            escapeToClose: false,
        });
    };
});

app.controller('CreateUserController', function ($window, $scope, $http, $uibModalInstance) {

    $scope.userForm = {
        email:'',
        password:'',
        status:'',
        role:''
    };

    $scope.ok = function () {
        $http({
            method: 'POST',
            url: webroot + '/api/create-user',
            data: $scope.userForm,
        }).then(function successCallback(response) {
            if (response.data.success && response.data.success === true) {
                $window.location.href = fullroot + '/user/update/' + response.data.id;
            } else {
                $scope.loginError = true;
            }
        }, function errorCallback() {

        });

    };
    $scope.cancel = function () {
        $uibModalInstance.close();
    };
});
app.controller('UpdateUserController', function ($scope,$window,$http) {
    $scope.user = $window.user;

    $scope.openTab = 1;

    $scope.blockUser = function (id) {
        var status = 3;
        if($scope.user.blockedUser){
             status = 10;
        }
        $http({
            method: 'POST',
            url: webroot + '/api/user-status-update',
            data: {userId: id, status: status},
        }).then(function successCallback(response) {
            console.log(response.data.success);
            if (response.data.success && response.data.success === 'OK') {
                $scope.user.blockedUser = !$scope.user.blockedUser;
            } else {

            }
        }, function errorCallback() {

        });


    }
    $scope.$watch('openTab', function ($new) {
        if($new == 2){
        }
    });

});