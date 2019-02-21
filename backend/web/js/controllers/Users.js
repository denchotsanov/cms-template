app.controller('UsersController', function ($scope,$timeout,$http,$window,$modal) {

    $scope.openPopup = function () {
        var modalInstance = $modal.open({
            templateUrl: 'myModalContent.html',
            controller: 'ModalInstanceCtrl',

            //size: size,
            resolve: {
                user: function() {
                    return userData;
                },
                selectedProducts: function() {
                    return userData.selectedProducts;
                },
                products: function () {
                    //console.log($scope.selectedProducts);
                    return $scope.products; // get all available products
                }
            }
        });

        modalInstance.result.then(function (selectedItems) {
            //products = selectedItems;
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    }

});