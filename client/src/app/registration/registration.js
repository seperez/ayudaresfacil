angular.module( 'AyudarEsFacilApp.registration', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'account.registration', {
        url: '/registration',
        controller: 'RegistrationCtrl',
        templateUrl: 'registration/registration.tpl.html',
        data:{ 
            pageTitle: 'Registrarme',
            bodyClass: 'login tooltips'
        }
    });
})

.controller( 'RegistrationCtrl', function RegistrationCtrl( $scope ) {

})

;
