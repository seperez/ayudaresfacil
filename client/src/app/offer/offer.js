angular.module( 'AyudarEsFacilApp.offer', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'offerList', {
        url: '/ofrecimientos',
        views: {
            "main": {
                controller: 'ofrecimientos',
                templateUrl: 'offer/offer-list.tpl.html'
            },
            "navigationBar": {
                templateUrl: 'navigationBar/institutional.tpl.html'
            } 
        },
        data:{ pageTitle: 'Ofrecimientos' }
    });
})

.controller( 'OfferCtrl', function OfferCtrl( $scope ) {

})

;
