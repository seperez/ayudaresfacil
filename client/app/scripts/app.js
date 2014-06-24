'use strict';

/**
 * @ngdoc overview
 * @name ayudarEsFacilApp
 * @description ayudaresfacil.org es una plataforma que permite a la comunidad hacer donaciones y ofrecimientos de una manera fácil e intuitiva.
 * # ayudarEsFacilApp
 *
 * Main module of the application.
 */
var ayudarEsFacilApp = angular.module('ayudarEsFacilApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
]);

ayudarEsFacilApp.config(function ($routeProvider) {
    $routeProvider
    .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
    })
    .when('/por-que-ayudar', {
        templateUrl: 'views/whyHelp.html',
        controller: 'WhyHelpCtrl'
    })
    .when('/casos-de-exito', {
        templateUrl: 'views/successStories.html',
        controller: 'SuccessStoriesCtrl'
    })
    .when('/conoce-el-proyecto', {
        templateUrl: 'views/meetTheProject.html',
        controller: 'MeetTheProjectCtrl'
    })
    .when('/ayudanos-a-ayudar', {
        templateUrl: 'views/helpUsToHelp.html',
        controller: 'HelpUsToHelpCtrl'
    })
    .otherwise({
        redirectTo: '/'
    });
});

