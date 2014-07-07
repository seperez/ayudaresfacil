angular.module( 'AyudarEsFacilApp.login', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'account.login', {
        url: '/login',
        controller: 'LoginCtrl',
        templateUrl: 'login/login.tpl.html',
        data:{ 
            pageTitle: 'Casos de éxito',
            bodyClass: "login tooltips"
        }
    });
})

.controller( 'LoginCtrl', function LoginCtrl( $scope ) {
})

;
