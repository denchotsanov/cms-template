'use strict';
var app = angular.module('backend', [
    'ngMaterial',
    'ngAria',
    'ngAnimate',
    'ui.bootstrap',
    'ngMessages',
    'ngSanitize',
    // 'ngCookies',
    // 'flow',
    // 'angular-drag',
    // 'ngMask'
])
.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);


