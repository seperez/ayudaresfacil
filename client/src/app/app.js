angular.module( 'AyudarEsFacilApp', [
    'templates-app',
    'templates-common',
    'AyudarEsFacilApp.home',
    'AyudarEsFacilApp.institutional',
    'AyudarEsFacilApp.offer',
    'AyudarEsFacilApp.mail',
    'AyudarEsFacilApp.sponsor',
    'AyudarEsFacilApp.user',
    'AyudarEsFacilApp.request',
    'ui.router',
    'services.breadcrumbs',
    'services.i18nNotifications',
    'services.httpRequestTracker',
    'directives.crud', 
    'directives.sessionNav',
    'ngResource'     
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
        })
        .state('account.404', {
            templateUrl: '404/404.tpl.html',
            url: '/pagina-no-encontrada',
            data:{ pageTitle: "Ups! Página no encontrada", bodyClass: 'login tooltips'}
        });

    $urlRouterProvider.when('', "/home");
    $urlRouterProvider.when('/', "/home");
    $urlRouterProvider.otherwise( '/pagina-no-encontrada' );
})

.run( function run ($rootScope) {
})

.controller( 'AppCtrl', function AppCtrl ( $scope, $location, $rootScope ) {
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
