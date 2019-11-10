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
            console.log(response.data.success);
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
app.controller('UpdateUserController', function ($scope,$window) {
    $scope.user = $window.user;
    $scope.openTab = 1;
});