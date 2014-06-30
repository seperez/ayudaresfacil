angular.module( 'AyudarEsFacilApp.login', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'login', {
        url: '/login',
        views: {
            "main": {
                controller: 'LoginCtrl',
                templateUrl: 'login/login.tpl.html'
            },
            "navigationBar": {
                templateUrl: 'navigationBar/institutional.tpl.html'
            } 
        },
        data:{ pageTitle: 'Casos de éxito' }
    });
})

.controller( 'LoginCtrl', function LoginCtrl( $scope ) {

})

;
