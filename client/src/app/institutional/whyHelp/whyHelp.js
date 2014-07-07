angular.module( 'AyudarEsFacilApp.institutional.whyHelp', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'web.whyHelp', {
        url: '/por-que-ayudar',
        controller: 'WhyHelpCtrl',
        templateUrl: 'institutional/whyHelp/whyHelp.tpl.html',
        data:{ pageTitle: 'Por que ayudar' }
    });
})

.controller( 'WhyHelpCtrl', function WhyHelpCtrl( $scope ) {

})

;
