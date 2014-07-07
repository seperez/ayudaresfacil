angular.module( 'AyudarEsFacilApp.institutional.successStories', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'web.successStories', {        
        url: '/casos-de-exito',
        controller: 'SuccessStoriesCtrl',
        templateUrl: 'institutional/successStories/successStories.tpl.html',
        data:{ pageTitle: 'Casos de éxito' }
    });
})

.controller( 'SuccessStoriesCtrl', function SuccessStoriesCtrl( $scope ) {

})

;
