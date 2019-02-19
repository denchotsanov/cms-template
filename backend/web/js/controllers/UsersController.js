controllers.controller('UsersController', ['$scope','$http', '$location', '$window',
    function ($scope, $http, $location, $window,$uibModal) {


        $scope.openModal = function () {
            var modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                controllerAs: 'pc',
                size: size,
                resolve: {
                    data: function () {
                        return pc.data;
                    }
                }
            });

            modalInstance.result.then(function () {
                alert("now I'll close the modal");
            });
        }

    }
]);