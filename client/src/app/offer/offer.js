angular.module( 'AyudarEsFacilApp.offer', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'web.offerList', {        
        url: '/ofrecimientos',
        controller: 'OfferCtrl',
        templateUrl: 'offer/offer-list.tpl.html',
        data:{ pageTitle: 'Ofrecimientos' }
    });
})

.controller( 'OfferCtrl', function OfferCtrl( $scope ) {

})

;
