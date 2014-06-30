angular.module( 'AyudarEsFacilApp.registration', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'registration', {
        url: '/registration',
        views: {
            "main": {
                controller: 'RegistrationCtrl',
                templateUrl: 'registration/registration.tpl.html'
            },
            "navigationBar": {
                templateUrl: 'navigationBar/institutional.tpl.html'
            } 
        },
        data:{ pageTitle: 'Casos de éxito' }
    });
})

.controller( 'RegistrationCtrl', function RegistrationCtrl( $scope ) {

})

;
