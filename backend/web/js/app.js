'use strict';

var app = angular.module('app', [
    'ngRoute',          //$routeProvider
    'controllers'       //Our module frontend/web/js/controllers.js
]);

app.config(['$routeProvider', '$httpProvider',
    function($routeProvider, $httpProvider) {
        $routeProvider.
        when('/', {
            templateUrl: 'partials/index.html'
        }).
        otherwise({
            templateUrl: 'partials/404.html'
        });
        //$httpProvider.interceptors.push('authInterceptor');
    }
]);

// app.factory('authInterceptor', function ($q, $window, $location) {
//     return {
//         request: function (config) {
//             if ($window.sessionStorage.access_token) {
//                 //HttpBearerAuth
//                 config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
//             }
//             return config;
//         },
//         responseError: function (rejection) {
//             if (rejection.status === 401) {
//                 $location.path('/login').replace();
//             }
//             return $q.reject(rejection);
//         }
//     };
// });