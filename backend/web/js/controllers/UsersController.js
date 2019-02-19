controllers.controller('UsersController', ['$scope','$http', '$location', '$window','$uibModal',
    function ($scope, $http, $location, $window, $uibModal) {
        $scope.openModal = function () {
            console.log($uibModal);

                var modalInstance = $uibModal.open({
                animation: true,
                ariaLabelledBy: 'modal-title',
                ariaDescribedBy: 'modal-body',
                //templateUrl: 'myModalContent.html',
                //controller: 'ModalInstanceCtrl',
                // size: size,
                resolve: {
                    data: function () {
                        return ''
                    }
                }
            });

            modalInstance.result.then(function () {
                alert("now I'll close the modal");
            });
        }

    }
]);