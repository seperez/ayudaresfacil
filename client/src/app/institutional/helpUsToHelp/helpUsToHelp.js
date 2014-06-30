angular.module( 'AyudarEsFacilApp.institutional.helpUsToHelp', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'helpUsToHelp', {
        url: '/ayudanos-a-ayudar',
        views: {
            "main": {
                controller: 'HelpUsToHelpCtrl',
                templateUrl: 'institutional/helpUsToHelp/helpUsToHelp.tpl.html'
            },
            "navigationBar": {
                templateUrl: 'navigationBar/institutional.tpl.html'
            } 
        },
        data:{ pageTitle: 'Casos de éxito' }
    });
})

.controller( 'HelpUsToHelpCtrl', function HelpUsToHelpCtrl( $scope ) {

})

;
