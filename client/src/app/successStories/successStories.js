angular.module( 'AyudarEsFacilApp.successStories', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'successStories', {
        url: '/casos-de-exito',
        views: {
            "main": {
                controller: 'SuccessStoriesCtrl',
                templateUrl: 'successStories/successStories.tpl.html'
            }
        },
        data:{ pageTitle: 'Casos de éxito' }
    });
})

.controller( 'SuccessStoriesCtrl', function SuccessStoriesCtrl( $scope ) {

})

;
