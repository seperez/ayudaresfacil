angular.module( 'AyudarEsFacilApp', [
    'templates-app',
    'templates-common',
    'AyudarEsFacilApp.home',
    'AyudarEsFacilApp.institutional',
    'AyudarEsFacilApp.login',
    'AyudarEsFacilApp.registration',
    'AyudarEsFacilApp.offer',
    'ui.router'
])

.config( function myAppConfig ( $stateProvider, $urlRouterProvider ) {
    $stateProvider
        .state('web', {
            templateUrl: 'layout/web.tpl.html'
        })
        .state('panel', {
            templateUrl: 'layout/panel.tpl.html'
        })
        .state('account', {
            template: '<ui-view/>'
        });

  
    $urlRouterProvider.otherwise( '/home' );
})

.run( function run () {
})

.controller( 'AppCtrl', function AppCtrl ( $scope, $location ) {
    $scope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams){
        if ( angular.isDefined( toState.data.pageTitle ) ) {
            $scope.pageTitle = toState.data.pageTitle + ' | AyudarEsFacil' ;
        }

        $scope.bodyClass = "";
        if ( angular.isDefined( toState.data.bodyClass ) ) {
            $scope.bodyClass = toState.data.bodyClass;
        }
    });
})

;
