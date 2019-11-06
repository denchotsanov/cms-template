app.controller('UsersController', function ($scope, $timeout, $window, $modal) {

    $scope.openPopup = function () {
        $modal.open({
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: webroot + '/user/create',
            controller: 'CreateUserController'
        });
    };
});

app.controller('CreateUserController', function ($modalInstance,$window, $scope, $http) {

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
        $modalInstance.dismiss('cancel');

    };
});

app.controller('UpdateUserController', function ($scope,$window) {
    $scope.user = $window.user;
    $scope.openTab = 1;
});